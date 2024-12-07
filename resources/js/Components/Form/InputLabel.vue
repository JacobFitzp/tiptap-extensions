<template>
    <label :for="field" class="mb-2 block">
        <slot />
    </label>
</template>

<script setup>
defineProps({
    field: {
        type: String,
        default: null,
    },
});
</script>
