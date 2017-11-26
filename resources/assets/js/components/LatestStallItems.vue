<template>
    <div class="latest-stall-items">
        <h2>
            Latest items
        </h2>

        <tab-picker
            :options="['Selling', 'Buying', 'All']"
            :option="type"
            :onOptionSelect="onOptionSelect"
            />

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
            No items found. Why not <a href="/my-stall">set up your stall?</a>
        </template>
    </div>
</template>

<script>

import StallItemList from './presentational/StallItemList.vue'
import DropdownPicker from './presentational/DropdownPicker.vue'
import TabPicker from './presentational/TabPicker.vue'
import Cookies from 'cookies-js'

export default {
    components: {
        'stall-item-list': StallItemList,
        'dropdown-picker': DropdownPicker,
        'tab-picker': TabPicker,
    },
    data() {
        return {
            page: 1,
            stallItems: [],
            type: 'selling',

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
        this.loading = true
        this.search()
    },
    methods: {
        search() {
            axios.get('/api/v1/stall-items/search', {
                params: {
                    type: this.type.toLowerCase(),
                    page: this.page,
                    server_id: Cookies.get('server')
                }
            }).then(this.onReceiveSearchResults);
        },

        onReceiveSearchResults(response) {
            const paginationResponse = response.data
            this.stallItems = paginationResponse.data
            this.paginationTotal = paginationResponse.total
            this.paginationLastPage = paginationResponse.last_page

            this.loading = false
            this.paginating = false
            this.showResults = true
        },
        onOptionSelect(type) {
            this.page = 1
            this.type = type

            Cookies.set('stall_search_type', type, { expires: Infinity })

            this.paginationChangePage(1)
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
