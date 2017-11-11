<template>
    <span :class="['item-price', priceClass]">
		{{ value | comma }}z
    </span>
</template>

<script>
import numeral from 'numeral'

export default {
    props: ['value'],
    data() {
    	return {
    		priceClass: 'thousands'
    	}
    },
    mounted() {
    	if(this.value < 100) {
    		this.priceClass = 'tens'
    	} else if(this.value < 1000) {
    		this.priceClass = 'hundreds'
    	} else if(this.value < 10000) {
    		this.priceClass = 'thousands'
    	} else if(this.value < 100000) {
    		this.priceClass = 'ten-thousands'
    	} else if(this.value < 1000000) {
    		this.priceClass = 'hundred-thousands'
    	} else if(this.value < 10000000) {
    		this.priceClass = 'millions'
    	} else if(this.value < 100000000) {
    		this.priceClass = 'ten-millions'
    	} else {
    		this.priceClass = 'hundred-millions'
    	}
    },
    filters: {
        comma: function(number) {
            return numeral(number).format('0,0');
        }
    },
    methods: {}
}
</script>