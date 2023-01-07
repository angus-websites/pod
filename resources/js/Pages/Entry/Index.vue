
<template>

    <PageContainer>
        <EntryTable :entries="entries['data']" />
    </PageContainer>

</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import PageContainer from "@/Components/_util/PageContainer.vue";
import EntryTable from "@/Components/dashboard/EntryTable.vue";
export default {
    layout: AppLayout,
    components: {
        PageContainer,
        EntryTable
    },
    props: ["entries"],
    mounted() {
        console.log(this.entries["data"])
    }
}
</script>


