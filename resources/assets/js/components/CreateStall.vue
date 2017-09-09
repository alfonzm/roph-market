<template>
	<div>
		<!-- Stall name -->
        <div>
            <label for="stall">Stall name</label>
            <input id="name" type="text" name="name" required autofocus>
        </div>

		<!-- Add item -->
		<form @submit.prevent="addItem">
			<label>Add an item</label>
			<item-search @onSelectSearchResult="onSelectSearchResult" v-model="query"></item-search>
			<input v-model="itemToAdd.price" type="text" placeholder="Price">
			<input v-model="itemToAdd.quantity" type="number" placeholder="Quantity">
			<input type="submit" value="Add item">
		</form>

		<!-- Items -->
        <div>
			Items:
			<ul>
				<li v-for="(item, index) in items">
					{{ item.name }} / {{ item.price }}z
					<input type="hidden" :name="'stall_items[' + index + '][ro_item_id]'" :value="item.id">
					<input type="hidden" :name="'stall_items[' + index + '][price]'" :value="item.price">
					<input type="hidden" :name="'stall_items[' + index + '][quantity]'" :value="item.quantity">
					<input type="button" value="Remove" @click="remove(index)">
				</li>
			</ul>
        </div>

        <div>
            <button type="submit">
                Create stall
            </button>
        </div>
	</div>	
</template>

<script>

import ItemSearch from './ItemSearch.vue'

export default {
	data() {
		return {
			query: null,
			itemToAdd: {},
			dropdownItems: [],
			items: [],
		}
	},
	mounted() {

	},
	components: {
		'item-search': ItemSearch
	},
	methods: {
		remove(index) {
			this.items.splice(index, 1)
		},
		onSelectSearchResult(roItem) {
			this.itemToAdd = roItem
		},
		addItem() {
			this.items.push(Object.assign({}, this.itemToAdd))
			this.itemToAdd = {}
			this.query = null
		}
	}
}
</script>