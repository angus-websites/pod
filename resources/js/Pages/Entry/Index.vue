
<template>
    <AppLayout title="Entries">
        <PageContainer>
            <EntryTable :entries="entries" />
        </PageContainer>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import PageContainer from "@/Components/_util/PageContainer.vue";
import EntryTable from "@/Components/dashboard/EntryTable.vue";
export default {
    components: {
        PageContainer,
        EntryTable,
        AppLayout
    },
    props: ["entries"],
    mounted() {
        console.log(this.entries["data"])
    }
}
</script>


