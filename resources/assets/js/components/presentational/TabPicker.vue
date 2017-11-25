<template>
	<ul class="tab-picker">
		<li
			v-for="option in options"
			@click.prevent="selectOption(option)"
			:class="{'active': option.toLowerCase() == selectedOption.toLowerCase()}"
			>
			{{ option }}

		</li>
	</ul>
</template>

<script>
import _ from 'lodash'
import Cookies from 'cookies-js'

export default {
	data() {
		return {
			selectedOption: null
		}
	},
	props: ['onOptionSelect', 'options', 'option'],
	watch: {
		option(newOption, oldOption) {
			this.selectedOption = newOption
		}
	},
	mounted() {
		this.selectedOption = this.option
	},
	methods: {
		selectOption(option) {
			if(this.onOptionSelect) {
				this.onOptionSelect(option)
			}

			this.selectedOption = option
		}
	}
}
</script>