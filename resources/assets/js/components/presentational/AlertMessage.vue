<template>
    <span :class="['alert-message', type]">
        <slot></slot>
    </span>
</template>

<script>

export default {
    props: ['message', 'type'],
}
</script>