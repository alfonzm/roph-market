<template>
	<img :src="src" />
</template>

<script>

export default {
	props: ['id', 'type'],
	data() {
		return {
		}
	},
	computed: {
		src() {
			return "http://imgs.ratemyserver.net/items/small/" + ((this.type == 6) ? "card" : this.id) + ".gif"
		}
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