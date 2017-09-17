<template>
	<form :method="method" :action="action" class="create-stall">
		<table class="create-stall-form">
			<colgroup>
				<col class="label">
				<col class="value">
			</colgroup>
			<tbody>
				<!-- Stall name -->
				<tr class="stall-name">
					<td class="label">
						Stall name
					</td>
					<td>
				        <input id="name" type="text" name="name" required autofocus placeholder="ex. PvP Equips and Cards">
					</td>
				</tr>

				<!-- Server -->
				<tr class="server">
					<td class="label">
						Server
					</td>
					<td>
						<select>
							<option value="1" selected>Thor</option>
							<option value="2">Loki</option>
						</select>
					</td>
				</tr>

				<!-- Description -->
				<tr class="stall-description">
					<td class="label" valign="top">
						Description
					</td>
					<td>
				        <textarea name="description" rows="3" placeholder="(optional) ex. I also accept trades. PM me for offers!"></textarea>
					</td>
				</tr>

				<!-- Add item -->
				<tr class="stall-add-item">
					<td class="label">
						Add items
					</td>
					<td>
						<!-- <form @submit.prevent="addItem"> -->
							<item-search @onSelectSearchResult="onSelectSearchResult" v-model="query"></item-search>
							<!-- <input v-model="itemToAdd.price" type="number" placeholder="Price" required>
							<input v-model="itemToAdd.quantity" type="number" placeholder="Quantity" min="1" required> -->
							<br>
							<!-- <input type="submit" value="Add item"> -->
						<!-- </form> -->
					</td>
				</tr>

				<!-- Items -->
				<tr class="stall-items">
					<td class="label" valign="top">
						Items in stall
					</td>
					<td>
						<span v-if="items.length <= 0" class="no-items">
							No items yet.
						</span>
						<table class="add-items-form" cellspacing="0" v-else>
							<tbody>
								<tr v-for="(item, index) in items">
									<td class="image">
										<ro-item-image :id="item.ro_item_id" :type="item.ro_item.type" />
									</td>
									<td class="name">
										<ro-item-name :ro-item="item.ro_item" />
									</td>
									<td class="fields">
										<input
											:name="`stall_items[${index}][quantity]`"
											type="number"
											v-model="item.quantity"
											placeholder="quantity"
											required>

										<input
											:name="`stall_items[${index}][price]`"
											type="number"
											v-model="item.price"
											placeholder="price">

										<template v-if="item.ro_item.refineable == 1">
											<input
												:name="`stall_items[${index}][refine]`"
												type="number"
												v-model="item.refine"
												placeholder="refine (0-10)">
										</template>

										<template v-for="slotIndex in item.ro_item.slots">
											<item-search
												@onSelectSearchResult="(roItem) => {
													items[index].cards[slotIndex-1] = roItem
												}"
												v-model="item.cardsQuery[slotIndex-1]"
												:type-filter="[6]"
												:placeholder="`card slot #${slotIndex}`" />

											<input
												v-if="(slotIndex-1) in item.cards && 'id' in item.cards[slotIndex-1]"
												type="hidden"
												:name="`stall_items[${index}][slots][${slotIndex}]`"
												v-model="item.cards[slotIndex-1].id"
												>
										</template>
									</td>
									<td class="remove">
										<a href="#" @click.prevent="remove(index)">remove</a>
									</td>


									<!-- Hidden fields -->
									<input type="hidden" :name="`stall_items[${index}][ro_item_id]`" :value="item.ro_item_id">
								</tr>
							</tbody>
						</table>
						<!-- <stall-item-list :stall-items="items"></stall-item-list> -->
					</td>
				</tr>
			</tbody>
		</table>

		<!-- hidden input fields -->
		<template v-for="(item, index) in items">
			<!-- <input type="hidden" :name="`stall_items[${index}][price]`" :value="item.price"> -->
			<!-- <input type="hidden" :name="`stall_items[${index}][quantity]`" :value="item.quantity"> -->
		</template>

		<br>
        <button type="submit">
            Create stall
        </button>

		<!-- CSRF Field -->
        <slot></slot>
	</form>	
</template>

<script>

import ItemSearch from './presentational/ItemSearch.vue'
import StallItemList from './presentational/StallItemList.vue'
import RoItemImage from './presentational/RoItemImage.vue'
import RoItemName from './presentational/RoItemName.vue'

export default {
	data() {
		return {
			query: null,
			itemToAdd: {
			},
			items: [],
		}
	},
	props: ['method', 'action'],
	mounted() {

	},
	components: {
		'item-search': ItemSearch,
		'stall-item-list': StallItemList,
        'ro-item-image': RoItemImage,
        'ro-item-name': RoItemName,
	},
	methods: {
		remove(index) {
			this.items.splice(index, 1)
		},
		onSelectSearchResult(roItem) {
			this.itemToAdd.price = null
			this.itemToAdd.quantity = null
			this.itemToAdd.cards = []
			this.itemToAdd.cardsQuery = []
			this.itemToAdd.ro_item = roItem
			this.itemToAdd.ro_item_id = roItem.id

			this.addItem()
		},
		addItem() {
			this.items.push(Object.assign({}, this.itemToAdd))
			this.itemToAdd = {}
			this.query = null
		}
	}
}
</script>