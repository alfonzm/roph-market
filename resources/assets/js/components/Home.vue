<template>
	<div>
		<h1>home component</h1>
	</div>	
</template>

<script>
import ItemSearch from './ItemSearch.vue'
import StallList from './StallList.vue'

export default {
	data() {
		return {
			items: [],
		}
	},
	components: {
		'item-search': ItemSearch,
		'stall-list': StallList,
	},
	mounted() {

	}
}
</script>