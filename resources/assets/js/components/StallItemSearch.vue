<template>
	<!-- <div class="ro-item-stall-search"> -->
	<div class="stall-item-search">
		<item-search
			placeholder="What are you looking for? (e.g. Marc Card, +7 Occult Wand)"
			@onSelectSearchResult="searchStallByRoItem"
			v-model="query"
			:autofocus="autofocus ? autofocus : null"
			/>
		<div class="search-results">
			<p class="searching" v-if="loading">Searching for stalls...</p>
			<template v-else-if="showResults">
				<h3>Search results for <strong>&ldquo;<ro-item-name :ro-item="roItemToSearch" />&rdquo;</strong></h3>
				<stall-item-list
					v-if="stallItems.length > 0"
					:stall-items="stallItems"
					timestamp="timestamp" />
				<span v-else>No results found.</span>
			</template>
		</div>
	</div>
</template>

<script>
import RoItemName from './presentational/RoItemName.vue'
import ItemSearch from './presentational/ItemSearch.vue'
import StallItemList from './presentational/StallItemList.vue'
import queryString from 'query-string'

export default {
	props: [
		'initial-stallItems',
		'initial-query',
		'initial-roItemToSearch',
		'autofocus',
		'redirect' // if set, onSelectSearchResult will redirect to /search page
	],
	data() {
		return {
			stallItems: [],
			query: null,
			roItemToSearch: {},

			loading: false,
			showResults: false
		}
	},
	created() {
		this.stallItems = this.initialStallItems
		this.query = this.initialQuery
		this.roItemToSearch = this.initialRoItemToSearch

		if(this.initialStallItems) {
			this.showResults = true
		}
	},
	components: {
		'item-search': ItemSearch,
        'stall-item-list': StallItemList,
        'ro-item-name': RoItemName
	},
	methods: {
		searchStallByRoItem(roItem) {
			const stringified = queryString.stringify({ s: roItem.id })
			const searchUrl = `/search?${stringified}`

			if(this.redirect) {
				window.location = searchUrl
				return
			} 

			window.history.pushState({path: searchUrl}, '', searchUrl)

			this.roItemToSearch = roItem
			this.loading = true
			axios.get('/api/v1/stall-items/search', {
				params: {
					s: roItem.id
				}
			}).then(response => {
				this.loading = false
				this.stallItems = response.data
				this.showResults = true
			});
		}
	}
}
</script>