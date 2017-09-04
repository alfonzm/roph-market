<template>
    <div>
        <ul>
            <template v-if="loading">
                Loading...
            </template>
            <template v-else>
                <li v-for="(stall, index) in stalls">
                    <a :href="`/stalls/${stall.id}`">{{ stall.name }}</a>
                </li>
            </template>
        </ul>
    </div>
</template>

<script>
    export default {
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
