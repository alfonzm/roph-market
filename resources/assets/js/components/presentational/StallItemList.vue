<template>
    <table cellspacing="0" class="stall-item-list">
        <tr>
            <th class="name" colspan="2">Item</th>
            <th class="quantity">
                Quantity
            </th>
            <th class="price">
                Price
            </th>
            <th v-if="timestamp" class="timestamp">
                Updated
            </th>
        </tr>
	    <stall-item-row v-for="(item, index) in stallItems" :key="item.id" :stall-item="item" :timestamp="timestamp" />
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
    ], 
    mounted() {
    },
    methods: {
    }
}
</script>