
<template>
    <PageContainer>
        <EntryTable :entries="entries" />
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

<!-- Second script to define layout -->
<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    layout: AppLayout

}
</script>
