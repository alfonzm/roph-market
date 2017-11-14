<template>
	<!-- <div class="ro-item-stall-search"> -->
	<div class="stall-item-search">
		<item-search
			placeholder="What are you looking for? (search for item name, item ID, or keywords)"
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
					<span class="subheader">Found {{ paginationTotal }} result(s)</span>
				</h3>

				<template v-if="stallItems.length > 0">
					<stall-item-list
						:stall-items="stallItems"
						:paginating="paginating"
						link-to-stall="true"
						timestamp="timestamp"
						/>
			        <paginate
			        	v-if="paginationLastPage > 1"

			        	:container-class="'pagination'"
			        	:page-class="'pagination-item'"
			        	:active-class="'active'"
			        	:prev-class="'pagination-prev'"
			        	:next-class="'pagination-next'"

			            :page-count="paginationLastPage"
			            :click-handler="paginationChangePage"
			            :margin-pages="1"
			            :initial-page="paginationData.current_page-1"
			            />
				</template>
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
import Cookies from 'cookies-js'

export default {
	props: [
		'pagination-data',
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

			searchParams: {
				page: 1,
				q: null,
				s: null,
			},

			paginating: false,
			paginationTotal: null,
			paginationLastPage: null,
			
			loading: false,
			showResults: false,
		}
	},
	created() {
		this.stallItems = this.paginationData.data
		this.paginationTotal = this.paginationData.total
		this.paginationLastPage = this.paginationData.last_page
		
		this.query = this.initialQuery
		this.roItemToSearch = this.initialRoItemToSearch

		if(this.roItemToSearch){
			this.$set(this.searchParams, 's', this.roItemToSearch.id)
		} else if(this.query) {
			this.$set(this.searchParams, 'q', this.query)
		}

		if(this.initialStallItems) {
			this.showResults = true
		}

		this.$set(this.searchParams, 'server_id', Cookies.get('server'))
	},
	components: {
		'item-search': ItemSearch,
        'stall-item-list': StallItemList,
        'ro-item-name': RoItemName
	},
	methods: {
		// Pagination
		paginationChangePage(page){ 
			this.paginating = true
			this.$set(this.searchParams, 'page', page)
			this.redirectSearch(this.searchParams)
			this.search()
		},

		// receive items
		onReceiveSearchResults(response) {
			const paginationResponse = response.data
			this.stallItems = paginationResponse.data
			this.paginationTotal = paginationResponse.total
			this.paginationLastPage = paginationResponse.last_page

			this.loading = false
			this.paginating = false
			this.showResults = true
		},
		redirectSearch(params) {
			var paramsToStringify = {}
			if(params.q) { paramsToStringify.q = params.q }
			if(params.s) { paramsToStringify.s = params.s }
			if(params.page) { paramsToStringify.page = params.page }

			const stringified = queryString.stringify(paramsToStringify)
			const searchUrl = `/search?${stringified}`

			if(this.redirect) {
				window.location.href = searchUrl
				return
			}

			window.history.pushState({path: searchUrl}, '', searchUrl)
		},
		searchStallItemByQuery(query) {
			this.$set(this.searchParams, 'q', query)
			this.$set(this.searchParams, 's', null)
			this.$set(this.searchParams, 'page', null)

			this.redirectSearch(this.searchParams)

			if(this.redirect) {
				return
			}

			this.loading = true
			this.roItemToSearch = null
			this.search()
		},
		searchStallItemByRoItem(roItem) {
			this.$set(this.searchParams, 's', roItem.id)
			this.$set(this.searchParams, 'q', null)
			this.$set(this.searchParams, 'page', null)

			this.redirectSearch(this.searchParams)

			if(this.redirect) {
				return
			}

			this.loading = true
			this.roItemToSearch = roItem
			this.search()
		},
		search() {
			axios.get('/api/v1/stall-items/search', {
				params: this.searchParams
			}).then(this.onReceiveSearchResults);
		}
	}
}
</script>