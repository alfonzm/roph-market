<template>
    <div class="item-list">
        <template v-if="loading">
            Loading...
        </template>
        <template v-else-if="stallItems.length > 0">
            <stall-item-list
                :stall-items="stallItems"
                link-to-stall="true"
                timestamp="timestamp"
                />
        </template>
        <template v-else>
            No items for sale found. Why not <a href="/stalls/create">create a stall?</a>
        </template>
    </div>
</template>

<script>

import StallItemList from './presentational/StallItemList.vue'
import Cookies from 'cookies-js'

export default {
    components: {
        'stall-item-list': StallItemList
    },
    data() {
        return {
            stallItems: [],
            loading: true
        }
    },
    mounted() {
        this.fetchItemsList()
    },
    methods: {
        fetchItemsList() {
            this.loading = true
            axios.get('/api/v1/stall-items', { server_id: Cookies.get('server') }).then((res) => {
                console.log(res.data)
                this.loading = false
                this.stallItems = res.data
            })
        }
    }
}
</script>
