<template>
    <table cellspacing="0" class="stall-list">
	    <stall-row
            v-for="(stall, index) in stalls"
            :key="stall.id"
            :name="stall.name"
            :id="stall.id"
            :server="stall.server ? stall.server.name : null"
            :timestamp="timeAgo(stall.created_at)" />
	</table>
</template>

<script>
import StallListRow from './StallListRow.vue'
import moment from 'moment'

export default {
    components: {
        'stall-row': StallListRow
    },
    props: ['stalls'],
    mounted() {
    },
    methods: {
        timeAgo(date) {
            return moment(date).fromNow()
        }
    }
}
</script>
