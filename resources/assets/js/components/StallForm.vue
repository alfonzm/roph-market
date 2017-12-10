<template>
	<div class="stall-form">
		<!-- Stall form -->
		<h2>
			<span class="capitalized">My {{ server }} Stall</span>
			<br>
			<div class="subheader view-stall-link"><a :href="`/stalls/${stall.id}`">View stall</a></div>
		</h2>

		<tab-picker
			class="stall-type-tab-picker"
			:options="['Selling','Buying']"
			:onOptionSelect="onSelectStallType"
			:option="'Selling'"
			/>

		<form :method="method" :action="action + (stall.id ? `/${stall.id}` : '')" @submit="onSubmit">
        	<input name="type" type="hidden" :value="stall.type" />
        	<input name="server_id" type="hidden" :value="stall.server_id" />
			
			<table class="stall-form-table" cellspacing="0">
				<colgroup>
					<col class="value">
				</colgroup>
				<tbody>
					<!-- Add item -->
					<tr class="stall-add-item">
						<td>
							<item-search
								@onSelectSearchResult="onSelectSearchResult"
								v-model="query"
								placeholder="Search for items to add to your stall..."
								/>
							<br>
						</td>
					</tr>

					<!-- Items -->
					<tr class="stall-items">
						<td>
							<span v-if="stall.stall_items.length <= 0" class="muted thin">
								No items yet.
							</span>
							<table class="add-items-form" cellspacing="0" v-else>
								<tbody>
									<tr>
										<th class="item" colspan="2">
											Item
										</th>
										<th class="quantity">Quantity</th>
										<th class="price">Price (optional)</th>
										<th class="refine" v-if="showRefineColumn">Refine</th>
										<th class="cards" v-if="showCardsColumn">Cards</th>
									</tr>

									<!-- Stall items -->
									<tr v-for="(item, index) in stall.stall_items" v-if="!item.removed" :class="{
											'is-deleting': (item.isDeleting == true),
											'is-expired': (item.expired == true)
										}">

										<td class="image">
											<ro-item-image :id="item.ro_item_id" :type="item.ro_item.type" />
										</td>
										<td class="name">
											<ro-item-name :ro-item="item.ro_item" />
											<input type="hidden"
												:name="`stall_items[${index}][id]`"
												v-model="item.id">

											<input type="hidden"
												:name="`stall_items[${index}][stall_id]`"
												v-model="stall.id">
										</td>
										<td class="quantity">
											<input
												:name="`stall_items[${index}][quantity]`"
												type="number"
												v-model="item.quantity"
												:disabled="item.expired"
												required
												>
										</td>
										<td class="price">
											<input
												:name="`stall_items[${index}][price]`"
												type="number"
												v-model="item.price"
												:disabled="item.expired"
												>
										</td>
										<td class="refine">
											<!-- Refine -->
											<template v-if="item.ro_item.refineable == 1">
												<input
													:name="`stall_items[${index}][refine]`"
													:disabled="item.expired"
													type="number"
													v-model="item.refine"
													min="0"
													max="10"
													placeholder="0-10"
													>
											</template>
											<template v-if="[34, 2].indexOf(item.ro_item.equip_locations) >= 0 && item.ro_item.type != 6">
												<div class="modifier">
													<select
														:name="`stall_items[${index}][modifier]`"
														:disabled="item.expired"
														v-model="item.modifier"
														>
														<option :value="null">No modifier</option>
														<option>Fire</option>
														<option>Ice</option>
														<option>Wind</option>
														<option>Earth</option>
														<option>Very Strong</option>
														<option>Very Very Strong</option>
														<option>Very Very Very Strong</option>
														<option>Very Strong Fire</option>
														<option>Very Strong Ice</option>
														<option>Very Strong Wind</option>
														<option>Very Strong Earth</option>
														<option>Very Very Strong Fire</option>
														<option>Very Very Strong Ice</option>
														<option>Very Very Strong Wind</option>
														<option>Very Very Strong Earth</option>
													</select>
												</div>
											</template>
										</td>
										<td class="cards">
											<!-- Cards slots -->
											<template v-for="slotIndex in item.ro_item.slots">
												<item-search
													@onSelectSearchResult="(roItem) => {
														addCard(index, slotIndex, roItem)
													}"
													:disabled="item.expired"
													v-model="item.cards[slotIndex-1].ro_item.name"
													:type-filter="[6]"
													:location-filter="item.ro_item.equip_locations"
													:placeholder="`card slot #${slotIndex}`" /><br>
											</template>
										</td>

										<!-- Remove button or re-add expired item -->
										<td class="remove">
											<input type="hidden" :name="`stall_items[${index}][expired]`" :value="item.expired ? 1 : 0">

											<template v-if="!item.expired">
												<a href="#" @click.prevent="remove(index, item)"><i class="fa fa-trash-o fa-lg"></i></a>
											</template>
											<div v-show="item.expired">
												<a href="#"
													@click.prevent=""
													class="expired-button"
													v-tippy="{
														arrow: true,
														theme: 'menu light',
														html: `#expired-popup-${index}`,
														delay: [0, 200],
														interactive: true,
													}"
													>
													<i class="fa fa-warning fa-lg"></i>
												</a>

												<!-- v-tippy tooltip template -->
												<div :id="`expired-popup-${index}`" class="popup">
													<strong>This item has expired (more than 10 days old).</strong><br/>
													Do you want to <a href="#" @click.prevent="readdExpiredStallItem(index, item)">add it again</a> it to your stall or <a href="#" @click.prevent="remove(index, item)">remove</a> it?
												</div>
											</div>

										</td>

										<!-- Hidden fields -->
										<input type="hidden" :name="`stall_items[${index}][ro_item_id]`" :value="item.ro_item_id">

										<template v-for="(card, slotIndex) in item.cards">
											<!-- Hidden card input -->
											<input
												v-if="card.ro_item.id && card.ro_item.name"
												type="hidden"
												:name="`stall_items[${index}][cards][${slotIndex}][card_id]`"
												v-model="card.ro_item.id"
												>

											<input
												type="hidden"
												:name="`stall_items[${index}][cards][${slotIndex}][id]`"
												v-model="card.id"
												>
										</template>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<br>
							<button type="submit">
					            Save
					        </button>
						</td>
					</tr>
				</tbody>
			</table>

			<br>
	        
	        <!-- method type -->
	        <input type="hidden" name="_method" :value="stall.id ? 'PUT' : 'POST'">

	        <!-- CSRF token -->
	        <slot></slot>
		</form>

		<!-- Delete stall form -->
		<template v-if="false">
			<h3>
				Delete stall
			</h3>
			<span>This will delete all items in your <strong class="capitalized brand-colored">{{ stall.type }}</strong> stall. This action cannot be undone.</span>
			<br>
			<br>
			<form method="POST" :action="action + (stall.id ? `/${stall.id}` : '')" onsubmit="return confirm('Are you sure you want to delete this stall?')">
				<input type="hidden" name="_method" value="DELETE">

				<!-- CSRF token -->
				<slot></slot>

		        <button type="submit" class="basic butto	n danger">
		            Delete items
		        </button>
		    </form>
		</template>
	</div>
</template>

<script>
import _ from 'lodash'
import moment from 'moment'
import Constants from './Constants'
import Cookies from 'cookies-js'
import TabPicker from './presentational/TabPicker.vue'
import ItemSearch from './presentational/ItemSearch.vue'
import StallItemList from './presentational/StallItemList.vue'
import RoItemImage from './presentational/RoItemImage.vue'
import RoItemName from './presentational/RoItemName.vue'

export default {
	data() {
		return {
			servers: Constants.servers,
			query: null,
			itemToAdd: {
				modifier: null
			},
			stall: Vue.util.extend({
				name: '',
				server_id: Cookies.get('server') || Constants.servers[0].id,
				stall_items: []
			}, this.initialStall)
		}
	},
	props: ['initialStall', 'method', 'action', 'server', 'stalls'],
	components: {
		'item-search': ItemSearch,
		'stall-item-list': StallItemList,
        'ro-item-image': RoItemImage,
        'ro-item-name': RoItemName,
        'tab-picker': TabPicker,
	},
	computed: {
		showRefineColumn() {
			for(var i=0; i < this.stall.stall_items.length; i++) {
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
	mounted() {
		let newStall = {
			name: '',
			server_id: Cookies.get('server') || Constants.servers[0].id,
			stall_items: []
		}

		this.stalls['buying'] = _.filter(this.stalls, { 'type' : 'buying' })[0] || Object.assign({}, newStall)
		this.stalls['selling'] = _.filter(this.stalls, { 'type' : 'selling' })[0] || Object.assign({}, newStall)

		this.stalls['buying'].type = 'buying'
		this.stalls['selling'].type = 'selling'

		this.stalls.map(stall => {
			stall.stall_items = stall.my_stall_items
		})

		this.stall = this.stalls['selling']

	},
	methods: {
		readdExpiredStallItem(index, stallItem) {
			axios.put(`/api/v1/stall-items/${stallItem.id}/touch`, {}).then((res) => {
				if(res.data.success) {
					this.$set(this.stall.stall_items[index], 'expired', false)
				}
			}).catch(err => {
				alert('Failed to update item. Please try again.')
				console.log(err)
			})
		},
		remove(index, stallItem) {
			if(stallItem.id) {
				this.$set(this.stall.stall_items[index], 'isDeleting', true)
				axios.delete(`/api/v1/stall-items/${stallItem.id}`, {}).then((res) => {
					this.$set(this.stall.stall_items[index], 'isDeleting', false)

	                if(res.data.success) {
						this.$set(this.stall.stall_items[index], 'removed', true)
	                } else {
	                	alert("Failed to remove item. Please try again.")
	                }
	            }).catch((err) => {
					this.$set(this.stall.stall_items[index], 'isDeleting', false)
	                alert(err.response.data.message)
	            })
			} else {
				this.$set(this.stall.stall_items[index], 'removed', true)
			}
		},
		addCard(stallItemIndex, slotIndex, roItem) {
			this.stall.stall_items[stallItemIndex].cards[slotIndex-1].ro_item = roItem
		},
		onSelectSearchResult(roItem) {
			this.itemToAdd.price = null
			this.itemToAdd.quantity = 1

			this.itemToAdd.cards = []
			for(var i=0; i < roItem.slots; i++ ){
				this.itemToAdd.cards.push({ ro_item: { name: '' }})
			}

			this.itemToAdd.ro_item = roItem
			this.itemToAdd.ro_item_id = roItem.id

			this.addItem()
		},
		addItem() {
			this.stall.stall_items.push(Object.assign({}, this.itemToAdd))
			this.itemToAdd = {
				modifier: null
			}
			this.query = null
		},
		onSubmit(e) {
			if(this.stall.stall_items.length <= 0) {
				alert('Stalls must have at least one item!')
				e.preventDefault()
				return false
			}

			return true
		},
		onSelectStallType(type) {
			this.stall = this.stalls[type.toLowerCase()]
		},
        timeAgo(date) {
            return moment(date).fromNow()
        },
        filterByExpiry(stallItems, expired) {
        	return _.filter(stallItems, {'expired': expired})
        },
        sortByExpiry(stallItems) {
        	return stallItems
        	// return _.sortBy(stallItems, 'expired')
        }
	}
}
</script>