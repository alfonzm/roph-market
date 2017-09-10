<template>
    <table cellspacing="0" class="stall-item-list">
	    <stall-item-row v-for="(item, index) in stallItems" :key="item.id" :stall-item="item" />
	</table>
</template>

<script>
import StallItemListRow from './StallItemListRow.vue'

export default {
    components: {
        'stall-item-row': StallItemListRow
    },
    props: ['stallItems'], //array of item objects
    mounted() {
    },
    methods: {
    }
}
</script>