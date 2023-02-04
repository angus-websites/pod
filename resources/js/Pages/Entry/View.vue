
<template>
  <AppLayout :title="entry.data.title">
    <PageContainer>
        <EntryHeader :title="entry.data.title" :date="entry.data.date"/>
        <!-- Buttons -->
        <div class="my-8">
            <!-- Cancel button -->
            <button v-if="currentView == editView" @click="switchTab(tabs[0])" class="bg-red-100 text-red-700 hover:bg-red-200 px-3 py-2 font-medium text-sm rounded-md">Cancel</button>

            <!-- Edit button -->
            <button v-else @click="switchTab(tabs[1])" class="text-gray-500 bg-gray-100 hover:text-gray-700 hover:bg-gray-200 px-3 py-2 font-medium text-sm rounded-md">Edit</button>

          </div>
        <!-- Dynamic view for edit or view -->
        <component :is="currentView" v-bind="currentProperties"></component>

    </PageContainer>
  </AppLayout>
</template>

<script setup>

//imports
import { reactive, computed, markRaw, ref } from 'vue';
import EntryView from '@/Components/entry/EntryView.vue';
import EntryEdit from '@/Components/entry/EntryEdit.vue';
import PageContainer from "@/Components/_util/PageContainer.vue";
import Breadcrumbs from "@/Components/_util/Breadcrumbs.vue";
import EntryHeader from "@/Components/entry/EntryHeader.vue";
import { useEntryStore } from '@/Stores/EntryStore.js';
import AppLayout from "@/Layouts/AppLayout.vue";
const props = defineProps(['entry'])

// Data
let readView = markRaw(EntryView); 
let editView = markRaw(EntryEdit);

// Reactive data
let currentView = ref(readView);
let tabs = reactive([
  { name: 'View', view: readView, current: true },
  { name: 'Edit', view: editView, current: false },
]);

function switchTab(tab){

    // Set the current view for this tab
    currentView.value = tab.view;

    // Reset all tabs
    tabs.forEach(element => element.current = false);

    // Update current
    tab.current = true;
}

// Computed
const currentProperties = computed(() => {
  return {"entry":  props.entry.data}
})


</script>
