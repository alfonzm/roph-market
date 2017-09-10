<template>
	<div class="item-search">
		<input type="text" ref="input" placeholder="What are you looking for? (e.g. Marc Card, +7 Occult Wand)" :value="value" @input="updateValue($event.target.value)"/>
		<div style="display: inline">
			<ul v-if="results.length > 0">
				<li v-for="item in results">
					<!-- roitem list item -->
					<ro-item-image :id="item.id" :type="item.type" />
					<a href="#" @click="selectItem(item)">
						{{ item.name }}
						<template v-if="item.slots > 0">
							[{{ item.slots }}]
						</template>
					</a>
					<span style="color: #aaa;">(#{{ item.id }})</span>
				</li>
			</ul>
		</div>
	</div>	
</template>

<script>

/* Make sure to have v-model="query" as item-search prop */

import RoItemImage from './RoItemImage.vue'

export default {
	props: ['value'],
	components: {
		'ro-item-image': RoItemImage
	},
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
		updateValue(value) {
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