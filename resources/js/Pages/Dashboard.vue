
<template>
    <AppLayout>
        <PageContainer>
            <EntryTable :entries="entries" />
        </PageContainer>
    </AppLayout>
</template>

<script setup>
import AppNavbar from "@/Components/_includes/AppNavbar.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageContainer from "@/Components/_util/PageContainer.vue";
import EntryTable from "@/Components/dashboard/EntryTable.vue";

const props = defineProps({
    entries: Object
})

</script>