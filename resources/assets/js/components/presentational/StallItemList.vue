<template>
    <div>
        <table cellspacing="0" :class="[{ paginating: paginating }, 'stall-item-list']">
            <tr>
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
                    Timestamp
                </th>
            </tr>
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