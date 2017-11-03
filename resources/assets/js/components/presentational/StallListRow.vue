<template>
    <tr class="stall-row">
        <td class="img">
            <img src="/img/vend.png">
        </td>
        <td class="name">
            <a :href="`/stalls/${id}`">
                {{ vendorName }}'s
                <span v-if="server" class="capitalized"> {{ server }} </span>
                Stall
            </a>
        </td>
        <td class="timestamp">
            {{ timestamp }}
            <!-- <a :href="`/stalls/${id}`"> -->
            <!-- </a> -->
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['vendor-name', 'id', 'timestamp', 'server'],
        mounted() {
        },
        methods: {
        }
    }
</script>
