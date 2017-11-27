<template>
    <div class="dropdown-picker" v-on-clickaway="close">
        <a href="#" @click.prevent="toggle">
        	<template v-if="selectedOption">
	        	{{ selectedOption }}
        	</template>
        	<i class="fa fa-caret-down"></i>
        </a>
        <div :class="{active: show}" class="dropdown-picker-options">
    		<a
				v-for="option in options"
        		href="#"
        		@click.prevent="selectOption(option)"
        		>
    			{{ option }}
    		</a>
        </div>
    </div>
</template>

<script>
import _ from 'lodash'
import { mixin as clickaway } from 'vue-clickaway'

export default {
	mixins: [ clickaway ],
	props: ['onOptionSelect', 'options', 'initialSelectedOptionIndex', 'option'],
	data() {
		return {
			show: false,
			selectedOption: null
		}
	},
	watch: {
		option(newOption, oldOption) {
			this.selectedOption = newOption
		}
	},
	mounted() {
		this.selectedOption = this.option
	},
	methods: {
		toggle() {
			this.show = !this.show
		},
		close() {
			this.show = false
		},
		selectOption(option) {
			// location.reload()
			if(this.onOptionSelect) {
				this.onOptionSelect(option)
			}

			this.show = false
			this.selectedOption = option
		}
	}
}
</script>