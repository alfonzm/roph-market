<template>
    <span>
    	{{ timeAgo(date) }}
    </span>
</template>

<script>
import moment from 'moment'

export default {
    props: ['date'],
    methods: {
		timeAgo: function(date) {
		    return moment(date).fromNow();
		}
    }
}
</script>