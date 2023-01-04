
<template>

    <AppNavbar />
    <p>All Entry page bro</p>

    <PageContainer>
        <EntryTable :entries="entries['data']" />
    </PageContainer>

</template>

<script setup>
import AppNavbar from "@/Components/_includes/AppNavbar.vue"
import PageContainer from "@/Components/_util/PageContainer.vue";
import EntryTable from "@/Components/dashboard/EntryTable.vue";

const props = defineProps({
    entries: Object
})
</script>
