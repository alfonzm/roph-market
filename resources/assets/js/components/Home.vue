<template>
	<div>
		<h1>home component</h1>
	</div>	
</template>

<script>
import ItemSearchBar from './ItemSearchBar.vue'
import StallList from './StallList.vue'

export default {
	data() {
		return {
			items: [],
		}
	},
	components: {
		'item-search-bar': ItemSearchBar,
		'stall-list': StallList,
	},
	mounted() {

	}
}
</script>