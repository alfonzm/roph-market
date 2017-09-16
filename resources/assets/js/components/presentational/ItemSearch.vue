<template>
	<div class="item-search">
		<input
			type="text"
			ref="input"
			:placeholder="placeholder || 'Search item...'"
			:value="value"
			:autofocus="autofocus ? autofocus : null"
			@input="updateValue($event.target.value)"
			@keydown.enter.prevent="onSearchFieldEnter"
			@keydown.down.prevent="onSearchFieldDown"
			@keydown.up.prevent="onSearchFieldUp"
			@keydown.esc.prevent="hideResults"
			@blur="hideResults"
			/>

		<!-- Results -->
		<ul class="results" v-if="results.length > 0 && showResults">
			<li v-for="(item, index) in results" :class="{'active' : isActive(index)}">
				<!-- roitem list item -->
				<a href="#" @mousedown="selectItem(item)">
					<ro-item-image :id="item.id" :type="item.type" />
					{{ item.name }}
					<template v-if="item.slots > 0">
						[{{ item.slots }}]
					</template>
					<span style="color: #aaa;">(#{{ item.id }})</span>
				</a>
			</li>
		</ul>
	</div>	
</template>

<script>

/* Make sure to have v-model="query" as item-search prop */

import RoItemImage from './RoItemImage.vue'

export default {
	props: ['value', 'placeholder', 'typeFilter', 'autofocus'],
	components: {
		'ro-item-image': RoItemImage
	},
	data() {
		return {
			showResults: true,
			current: 0,
			results: [],
			searchTimeout: null,
			loading: true
		}
	},
	methods: {
		hideResults() {
			this.showResults = false
		},
		isActive(index) {
			return this.current == index
		},
		onSearchFieldEnter(item) {
			this.selectItem(this.results[this.current])
		},
		onSearchFieldDown() {
			this.showResults = true

			if(this.current < this.results.length - 1) {
				this.current++
			}
		},
		onSearchFieldUp() {
			this.showResults = true

			if(this.current > 0) {
				this.current--
			}
		},
		selectItem(selectedItem) {
			this.results = []
			this.current = 0

			clearTimeout(this.searchTimeout)
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
						s: this.value,
						type: this.typeFilter
					}
				}).then(response => {
					this.showResults = true
					this.loading = false
					this.results = response.data
					this.current = 0
				});
			}
		}
	}
}
</script>