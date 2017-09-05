<template>
	<div style="display: inline">
		<input type="text" ref="input" placeholder="Search for an item..." v-model="query" @input="fetchSearchResults($event.target.value)"/>
		<div style="display: inline">
			<ul v-if="results.length > 0">
				<li v-for="result in results">
					<a href="#" @click="selectItem(result)">{{ result.name }}</a>
				</li>
			</ul>
		</div>
	</div>	
</template>

<script>

export default {
	props: ['value'],
	data() {
		return {
			query: '',
			results: [],
			searchTimeout: null,
			loading: true
		}
	},
	mounted() {
		this.query = this.value || ''
	},
	watch: {
		value: function(val) {
			this.query = val
		}
	},
	methods: {
		selectItem(selectedItem) {
			this.results = []
			this.query = selectedItem.name
			// this.$emit('input', selectedItem.name)
			this.$emit('onSelectSearchResult', selectedItem)
		},
		fetchSearchResults(value) {
			// this.$emit('input', value)
			clearTimeout(this.searchTimeout)
			this.searchTimeout = setTimeout(this.search, 250)
		},
		search() {
			if(this.query == '') {
				this.results = []
			} else {
				this.loading = true

				axios.get('/api/v1/ro-items/search', {
					params: {
						s: this.query
					}
				}).then(response => {
					this.loading = false
					this.results = response.data
				});
			}
		}
	}
}
</script>