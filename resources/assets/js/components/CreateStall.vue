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
			<input v-model="item.roItemId" type="text" placeholder="Item ID">
			<input v-model="item.price" type="text" placeholder="Price">
			<input type="submit">
		</form>

		<!-- Items -->
        <div>
			Items:
			<ul>
				<li v-for="(item, index) in items">
					{{ item.roItemId }} / {{ item.price }}
					<input type="hidden" :name="'stall_items[' + index + '][ro_item_id]'" :value="item.roItemId">
					<input type="hidden" :name="'stall_items[' + index + '][price]'" :value="item.price">
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

export default {
	data() {
		return {
			item: {
				price: null,
				roItemId: null
			},
			dropdownItems: [],
			items: [],
		}
	},
	mounted() {

	},
	methods: {
		addItem() {
			this.items.push(this.item)
			this.item = {}
			console.log(this.item.name)
			console.log(this.item.price)
		}
	}
}
</script>