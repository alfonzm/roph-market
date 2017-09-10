<template>
    <table cellspacing="0">
	    <stall-row v-for="(stall, index) in stalls" :key="stall.id" :name="stall.name" :id="stall.id" :timestamp="stall.created_at" />
	</table>
</template>

<script>
import StallListRow from './StallListRow.vue'

export default {
    components: {
        'stall-row': StallListRow
    },
    props: ['stalls'],
    mounted() {
    },
    methods: {
    }
}
</script>
