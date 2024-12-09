<template>
    <div v-if="error" class="mt-1 text-sm text-red-600">{{ error }}</div>
</template>

<script setup>
defineProps({
    error: {
        type: [String, null],
        required: true,
    },
});
</script>
