
<template>
  <AppLayout title="New Entry">
    <PageContainer>
        <div class="flex flex-col space-y-5">
            <Heading1 text="New Entry" />
            <EntryEdit :entry="new_entry" :create="true" />
        </div>
    </PageContainer>
  </AppLayout>
</template>

<script setup>

//imports
import AppLayout from "@/Layouts/AppLayout.vue";
import PageContainer from "@/Components/_util/PageContainer.vue";
import Heading1 from "@/Components/headings/Heading1.vue";
import EntryEdit from "@/Components/entry/EntryEdit.vue";

const props = defineProps(['new_entry'])


</script>
