
<template>
    <AppLayout title="Dashboard">
        <PageContainer>
            <Heading1>Dashboard</Heading1>
        </PageContainer>
    </AppLayout>
</template>

<script setup>
import AppNavbar from "@/Components/_includes/AppNavbar.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageContainer from "@/Components/_util/PageContainer.vue";
import EntryTable from "@/Components/dashboard/EntryTable.vue";
import Heading1 from "@/Components/headings/Heading1.vue";

const props = defineProps({
    entries: Object
})

</script>