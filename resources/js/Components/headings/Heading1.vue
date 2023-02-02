<template>
    <h1 class="mt-2 text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
        {{ text }}
     </h1>
</template>

<script setup>
const props = defineProps({
    text: {
        type: String,
    },
})
</script>
