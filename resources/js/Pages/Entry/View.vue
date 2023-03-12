
<template>
  <AppLayout :title="entry.title">
    <PageContainer>
        <EntryHeader :title="entry.title"/>

        <div class="sm:flex items-center my-5 sm:my-0">
          <!-- Buttons -->
          <div class="flex-auto">
            <div class="mb-8 mt-5 space-x-5 flex items-center flex-row">

                <!-- Cancel button -->
                <div v-if="currentView == editView">
                  <button  @click="switchTab(tabs[0])" class="bg-red-100 text-red-700 hover:bg-red-200 px-3 py-2 font-medium text-sm rounded-md">Cancel</button>
                </div>

                <div v-else-if="props.can.editEntry">
                  <!-- Edit button -->
                  <button  @click="switchTab(tabs[1])" class="text-gray-500 bg-blue-100 hover:text-blue-700 hover:bg-blue-200 px-3 py-2 font-medium text-sm rounded-md">Edit</button>
                </div>
            </div>
          </div>
          <!-- Template type -->
          <div>
            <span class="inline-flex items-center rounded-md bg-indigo-100 px-2.5 py-0.5 text-sm font-medium text-indigo-800">{{template.name}}</span>
          </div>
        </div>
        <!-- Dynamic view for edit or view -->
        <component :is="currentView" v-bind="currentProperties" @tab-toggle="tabToggle()"></component>

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
import { ChevronLeftIcon } from '@heroicons/vue/20/solid'


const props = defineProps(['entry', 'can', 'template'])

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

function tabToggle(){
  if (currentView.value == tabs[0].view){
    switchTab(tabs[1])
  }
  else{
    switchTab(tabs[0])
  }
}

// Computed
const currentProperties = computed(() => {
  if (currentView.value == readView){
    return {"entry":  props.entry, "template": props.template}
  }
  return {"entry":  props.entry, "template": props.template, "can": props.can}
})


</script>
