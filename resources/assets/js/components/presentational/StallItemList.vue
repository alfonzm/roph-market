<template>
    <table cellspacing="0" class="stall-item-list">
        <tr>
            <th colspan="2" class="name">Item</th>
            <th class="quantity">
                Quantity
            </th>
            <th class="price">
                Price
            </th>
            <th v-if="linkToStall" class="link-to-stall">
                Stall
            </th>
            <th v-if="timestamp" class="timestamp">
                Updated
            </th>
        </tr>
	    <stall-item-row v-for="(item, index) in stallItems" :key="item.id" :stall-item="item" :timestamp="timestamp" :link-to-stall="linkToStall" />
	</table>
</template>

<script>
// Props: array of stallitems

import StallItemListRow from './StallItemListRow.vue'

export default {
    components: {
        'stall-item-row': StallItemListRow
    },
    props: [
        'stallItems', //array of StallItem objects
        'timestamp',
        'linkToStall'
    ], 
    mounted() {
    },
    methods: {
    }
}
</script>