<template>
    <a href="{{ link}}" class="inline-flex items-center justify-center whitespace-nowrap rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700">
        <slot/>
    </a>
</template>

<script>
export default {
    name: "PrimaryButton",
    props: ['link'],
}
</script>

