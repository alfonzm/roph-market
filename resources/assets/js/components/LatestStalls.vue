<template>
    <div class="latest-stalls">
        <template v-if="loading">
            Loading...
        </template>
        <template v-else-if="stalls.length > 0">
            <stall-list :stalls="stalls" />
        </template>
        <template v-else>
            No stalls found. Why not <a href="/my-stall">set up your stall?</a>
        </template>
    </div>
</template>

<script>

import StallList from './presentational/StallList.vue'

export default {
    components: {
        'stall-list': StallList
    },
    data() {
        return {
            stalls: [],
            loading: true
        }
    },
    mounted() {
        this.fetchStallsList()
    },
    methods: {
        fetchStallsList() {
            this.loading = true
            axios.get('/api/v1/stalls').then((res) => {
                this.loading = false
                this.stalls = res.data
            })
        }
    }
}
</script>
