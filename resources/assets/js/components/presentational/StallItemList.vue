<!-- 

StallItemList - receives a list of StallItems to display in a table

Props:
stallItems - (bool) array of stall items
timestamp - (bool) display timestamp column or not
linkToStall - (bool) whether to display the link to stall column or not
paginating - (bool) like isLoading but for loading next pages

 -->

<template>
    <div>
        <table cellspacing="0" :class="[{ paginating: paginating }, 'stall-item-list']">
            <thead>
                <th colspan="2" class="name">Item</th>
                <th v-if="linkToStall" class="link-to-stall">
                    Stall
                </th>
                <th class="quantity">
                    Quantity
                </th>
                <th class="price">
                    Price
                </th>
                <th v-if="timestamp" class="timestamp">
                    Added
                </th>
            </thead>
    	    <stall-item-row v-for="(item, index) in stallItems" :key="item.id" :stall-item="item" :timestamp="timestamp" :link-to-stall="linkToStall" />
    	</table>
    </div>
</template>

<script>
// Props: array of stallitems

import StallItemListRow from './StallItemListRow.vue'

export default {
    components: {
        'stall-item-row': StallItemListRow
    },
    props: [
        'stallItems', //array of StallItem objects with stall, roItem and cards
        'timestamp',
        'linkToStall',
        'paginating', // loading pagination
    ], 
    mounted() {
    },
    methods: {
    }
}
</script>