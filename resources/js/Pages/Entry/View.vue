
<template>

    <AppNavbar />
    <p v-if="entry">{{ entry.data.title }}</p>


    <PageContainer>
        Content
    </PageContainer>

</template>

<script setup>
import AppNavbar from "@/Components/_includes/AppNavbar.vue"
import PageContainer from "@/Components/_util/PageContainer.vue";

const props = defineProps({
    entry: Object
})
</script>
