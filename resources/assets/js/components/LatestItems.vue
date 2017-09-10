<template>
    <div class="item-list">
        <template v-if="loading">
            Loading...
        </template>
        <template v-else>
            <stall-item-list :items="items"></stall-item-list>
        </template>
    </div>
</template>

<script>

import StallItemList from './presentational/StallItemList.vue'

export default {
    components: {
        'stall-item-list': StallItemList
    },
    data() {
        return {
            items: [],
            loading: true
        }
    },
    mounted() {
        this.fetchItemsList()
    },
    methods: {
        fetchItemsList() {
            this.loading = true
            this.loading = false
            // axios.get('/api/v1/stalls').then((res) => {
            //     this.loading = false
            //     this.stalls = res.data
            // })
        }
    }
}
</script>
