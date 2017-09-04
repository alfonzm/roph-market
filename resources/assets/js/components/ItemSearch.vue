<template>
	<div style="display: inline">
		<input type="text" ref="input" placeholder="Search for an item..." :value="value" @input="fetchSearchResults($event.target.value)"/>
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
			results: [],
			searchTimeout: null,
			loading: true
		}
	},
	methods: {
		selectItem(selectedItem) {
			this.results = []
			this.$emit('input', selectedItem.name)
			this.$emit('onSelectSearchResult', selectedItem)
		},
		fetchSearchResults(value) {
			this.$emit('input', value)
			clearTimeout(this.searchTimeout)
			this.searchTimeout = setTimeout(this.search, 250)
		},
		search() {
			if(this.value == '') {
				this.results = []
			} else {
				this.loading = true
				
				axios.get('/api/v1/ro-items/search', {
					params: {
						s: this.value
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