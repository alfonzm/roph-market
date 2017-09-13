<template>
    <span>
        <template v-if="refine > 0">+{{ refine }} </template>{{ roItem.name }} <template v-if="roItem.slots > 0">[{{ roItem.slots }}]</template>
    </span>
</template>

<script>

export default {
    props: ['roItem', 'refine'],
}
</script>