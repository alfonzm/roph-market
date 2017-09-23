<template>
    <tr class="stall-row">
        <td class="img">
            <img src="/img/vend.png">
        </td>
        <td class="name">
            <a :href="`/stalls/${id}`">
                {{ name }}
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
        props: ['name', 'id', 'timestamp'],
        mounted() {
        },
        methods: {
        }
    }
</script>
