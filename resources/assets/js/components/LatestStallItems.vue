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
                :paginating="paginating"
                />       

            <paginate
                v-if="paginationLastPage > 1"

                :container-class="'pagination'"
                :page-class="'pagination-item'"
                :active-class="'active'"
                :prev-class="'pagination-prev'"
                :next-class="'pagination-next'"

                :page-count="paginationLastPage"
                :click-handler="paginationChangePage"
                :margin-pages="1"
                :initial-page="page-1"
                />
        </template>
        <template v-else>
            No items for sale found. Why not <a href="/my-stall">set up your stall?</a>
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
            page: 1,
            stallItems: [],

            paginating: false,
            paginationTotal: null,
            paginationLastPage: null,
            
            loading: false,
            showResults: false,
        }
    },
    created() {

    },
    mounted() {
        this.search()
    },
    methods: {
        // fetchItemsList() {
        //     this.loading = true
        //     axios.get('/api/v1/stall-items', { server_id: Cookies.get('server') }).then((res) => {
        //         this.loading = false
        //         this.stallItems = res.data
        //     })
        // },

        search() {
            axios.get('/api/v1/stall-items/search', {
                params: {
                    page: this.page,
                    server_id: Cookies.get('server')
                }
            }).then(this.onReceiveSearchResults);
        },

        onReceiveSearchResults(response) {
            console.log(response)
            const paginationResponse = response.data
            this.stallItems = paginationResponse.data
            this.paginationTotal = paginationResponse.total
            this.paginationLastPage = paginationResponse.last_page

            this.loading = false
            this.paginating = false
            this.showResults = true
        },

        // Pagination
        paginationChangePage(page){ 
            this.paginating = true
            this.page = page
            this.search()
        },
    }
}
</script>
