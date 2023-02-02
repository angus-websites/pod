
<template>
  <AppLayout title="New Entry">
    <PageContainer>
        <div class="flex flex-col space-y-5">
            <EntryHeaderCreate />
            <EntryEdit :entry="new_entry" :create="true" />
        </div>
    </PageContainer>
  </AppLayout>
</template>

<script setup>

//imports
import AppLayout from "@/Layouts/AppLayout.vue";
import PageContainer from "@/Components/_util/PageContainer.vue";
import EntryEdit from "@/Components/entry/EntryEdit.vue";
import EntryHeaderCreate from "@/Components/entry/EntryHeaderCreate.vue";

const props = defineProps(['new_entry'])


</script>
