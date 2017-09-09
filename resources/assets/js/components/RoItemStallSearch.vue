<template>
	<div style="display: inline">
		<item-search @onSelectSearchResult="searchStallByRoItem" v-model="query"></item-search>
		<div>
			<span v-if="loading">Loading stalls...</span>
			<ul v-else>
				<li v-for="(stall, index) in results">
					<a :href="'/stalls/' + stall.id">{{ stall.name }}</a>
				</li>
			</ul>
		</div>
	</div>
</template>

<script>
import ItemSearch from './ItemSearch.vue'

export default {
	data() {
		return {
			query: '',
			results: [],
			loading: false
		}
	},
	components: {
		'item-search': ItemSearch
	},
	methods: {
		searchStallByRoItem(roItem) {
			this.loading = true
			axios.get('/api/v1/stalls/search', {
				params: {
					i: roItem.id
				}
			}).then(response => {
				this.loading = false
				this.results = response.data
			});
		}
	}
}
</script>