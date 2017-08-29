<template>
	<div>
		<input type="text" placeholder="Search for an item..." />
		<input type="submit" value="Search">
	</div>	
</template>

<script>
import ItemSearchBar from './ItemSearchBar.vue'

export default {
	data() {
		return {
			test: 'hi'
		}
	},
	components: {
		'item-search-bar': ItemSearchBar
	},
	mounted() {

	}
}
</script>