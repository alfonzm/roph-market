<template>
	<form :method="method" :action="action" class="stall-form">
		<table class="stall-form">
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
				        <input
				        	id="name"
				        	type="text"
				        	name="name"
				        	v-model="stall.name"
				        	placeholder="ex. PvP Equips and Cards"
				        	required autofocus>
					</td>
				</tr>

				<!-- Server -->
				<tr class="server">
					<td class="label">
						Server
					</td>
					<td>
						<select name="server_id" v-model="stall.server_id">
							<option value="1" :selected="stall.server_id == 1 ? 'selected' : null">Thor</option>
							<option value="2" :selected="stall.server_id == 2 ? 'selected' : null">Loki</option>
						</select>
					</td>
				</tr>

				<!-- Description -->
				<tr class="stall-description">
					<td class="label" valign="top">
						Description
					</td>
					<td>
				        <textarea v-model="stall.description" name="description" rows="3" placeholder="(optional) ex. I also accept trades. PM me for offers!"></textarea>
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
						<span v-if="stall.stall_items.length <= 0" class="no-items">
							No items yet.
						</span>
						<table class="add-items-form" cellspacing="0" v-else>
							<tbody>
								<tr>
									<th colspan="2">
										Item
									</th>
									<th class="quantity">Quantity</th>
									<th class="price">Price</th>
									<th class="refine" v-if="showRefineColumn">Refine</th>
									<th class="cards" v-if="showCardsColumn">Cards</th>
								</tr>
								<tr v-for="(item, index) in stall.stall_items">
									<td class="image">
										<ro-item-image :id="item.ro_item_id" :type="item.ro_item.type" />
									</td>
									<td class="name">
										<ro-item-name :ro-item="item.ro_item" />
									</td>
									<td class="quantity">
										<input
											:name="`stall_items[${index}][quantity]`"
											type="number"
											v-model="item.quantity"
											required
											>
									</td>
									<td class="price">
										<input
											:name="`stall_items[${index}][price]`"
											type="number"
											v-model="item.price"
											>
									</td>
									<td class="refine" v-if="showRefineColumn">
										<!-- Refine -->
										<template v-if="item.ro_item.refineable == 1">
											<input
												:name="`stall_items[${index}][refine]`"
												type="number"
												v-model="item.refine"
												min="0"
												max="10"
												placeholder="0-10"
												>
										</template>
									</td>
									<td class="cards" v-if="showCardsColumn">
										<!-- Cards slots -->
										<template v-for="slotIndex in item.ro_item.slots">
											<item-search
												@onSelectSearchResult="(roItem) => {
													addCard(index, slotIndex, roItem)
												}"
												v-model="item.cards[slotIndex-1].ro_item.name"
												:type-filter="[6]"
												:location-filter="item.ro_item.equip_locations"
												:placeholder="`card slot #${slotIndex}`" /><br>
										</template>
									</td>
									<td class="remove">
										<a href="#" @click.prevent="remove(index)">remove</a>
									</td>


									<!-- Hidden fields -->
									<input type="hidden" :name="`stall_items[${index}][ro_item_id]`" :value="item.ro_item_id">
									<template v-for="(card, slotIndex) in item.cards">
										<input
											v-if="card.ro_item.id"
											type="hidden"
											:name="`stall_items[${index}][cards][${slotIndex}]`"
											v-model="card.ro_item.name"
											>
									</template>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>

		<br>
        <button type="submit">
            Submit
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
			stall: Vue.util.extend({
				server_id: 1,
				stall_items: []
			}, this.initialStall)
		}
	},
	props: ['initialStall', 'method', 'action'],
	components: {
		'item-search': ItemSearch,
		'stall-item-list': StallItemList,
        'ro-item-image': RoItemImage,
        'ro-item-name': RoItemName,
	},
	mounted() {
		console.log(this.stall)
	},
	computed: {
		showRefineColumn() {
			for(var i=0; i < this.stall.stall_items.length; i++) {
				console.log(this.stall.stall_items[i].ro_item.refineable)
				if(this.stall.stall_items[i].ro_item.refineable > 0) {
					return true
				}
			}

			return false
		},
		showCardsColumn() {
			for(var i=0; i < this.stall.stall_items.length; i++) {
				if(this.stall.stall_items[i].ro_item.slots > 0) {
					return true
				}
			}

			return false
		},
	},
	methods: {
		remove(index) {
			this.stall.stall_items.splice(index, 1)
		},
		addCard(stallItemIndex, slotIndex, roItem) {
			this.stall.stall_items[stallItemIndex].cards[slotIndex-1].ro_item = roItem
		},
		onSelectSearchResult(roItem) {
			this.itemToAdd.price = null
			this.itemToAdd.quantity = null

			this.itemToAdd.cards = []
			this.itemToAdd.cards[0] = { ro_item: { name: '' }}
			this.itemToAdd.cards[1] = { ro_item: { name: '' }}
			this.itemToAdd.cards[2] = { ro_item: { name: '' }}
			this.itemToAdd.cards[3] = { ro_item: { name: '' }}

			this.itemToAdd.ro_item = roItem
			this.itemToAdd.ro_item_id = roItem.id

			this.addItem()
		},
		addItem() {
			this.stall.stall_items.push(Object.assign({}, this.itemToAdd))
			this.itemToAdd = {}
			this.query = null
		}
	}
}
</script>