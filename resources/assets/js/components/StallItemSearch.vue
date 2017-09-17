<template>
	<!-- <div class="ro-item-stall-search"> -->
	<div class="stall-item-search">
		<item-search
			placeholder="What are you looking for? (e.g. Marc Card, +7 Occult Wand)"
			@onSelectSearchResult="searchStallItemByRoItem"
			@onEnterQuery="searchStallItemByQuery"
			v-model="query"
			:autofocus="autofocus ? autofocus : null"
			/>
		<div class="search-results">
			<p class="searching" v-if="loading">Searching for stalls...</p>
			<template v-else-if="showResults">
				<h3>
					Search results for
					<strong>
						&ldquo;<ro-item-name v-if="roItemToSearch" :ro-item="roItemToSearch" /><span v-else>{{ query }}</span>&rdquo;
				</strong>
				</h3>
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
		'initial-stall-items',
		'initial-query',
		'initial-ro-item-to-search',
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
		onReceiveSearchResults(response) {
			this.loading = false
			this.stallItems = response.data
			this.showResults = true
		},
		redirectSearch(searchParams) {
			const stringified = queryString.stringify(searchParams)
			const searchUrl = `/search?${stringified}`

			if(this.redirect) {
				window.location = searchUrl
				return
			}

			window.history.pushState({path: searchUrl}, '', searchUrl)

		},
		searchStallItemByQuery(query) {
			const params = { q: query }
			if(this.redirect) {
				this.redirectSearch(params)
				return
			}

			this.roItemToSearch = null
			this.loading = true

			axios.get('/api/v1/stall-items/search', {
				params: params
			}).then(this.onReceiveSearchResults);

		},
		searchStallItemByRoItem(roItem) {
			const params = { s: roItem.id }
			
			if(this.redirect) {
				this.redirectSearch(params)
				return
			}

			this.roItemToSearch = roItem
			this.loading = true

			axios.get('/api/v1/stall-items/search', {
				params: params
			}).then(this.onReceiveSearchResults);
		}
	}
}
</script>