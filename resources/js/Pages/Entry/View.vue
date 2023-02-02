
<template>
  <AppLayout :title="entry.data.title">
    <PageContainer>
        <EntryHeader :title="entry.data.title" :date="entry.data.date"/>
        <!-- Tabs -->
        <div class="my-8">
            <div class="sm:hidden">
              <label for="tabs" class="sr-only">Select a tab</label>
              <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
              <select id="tabs" name="tabs" class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                <option v-for="tab in tabs" :key="tab.name" :selected="tab.current">{{ tab.name }}</option>
              </select>
            </div>
            <div class="hidden sm:block">
              <nav class="flex space-x-4" aria-label="Tabs">
                <button v-for="tab in tabs" @click="switchTab(tab)"  :key="tab.name" :class="[tab.current ? 'bg-indigo-100 text-indigo-700' : 'text-gray-500 hover:text-gray-700', 'px-3 py-2 font-medium text-sm rounded-md']" :aria-current="tab.current ? 'page' : undefined">{{ tab.name }}</button>
              </nav>
            </div>
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
    console.log(currentView.value)

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
