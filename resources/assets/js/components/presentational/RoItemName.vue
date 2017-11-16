<template>
    <span>
        <template v-if="refine > 0">+{{ refine }} </template><template v-if="modifier">{{ modifier }} </template>{{ roItem.name }}<template v-if="roItem.slots > 0"> [{{ roItem.slots }}]</template>
    </span>
</template>

<script>

export default {
    props: ['roItem', 'refine', 'modifier'],
}
</script>