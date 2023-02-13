
<template>
  <AppLayout title="New Entry">
    <PageContainer>
        <div class="flex flex-col space-y-10">
            <EntryHeaderCreate />
            

            <!-- Template selection -->
            <div>
              <label for="location" class="block text-sm font-medium text-gray-700">Template</label>
              <select v-model="selected_template" class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                <option v-for="template in templates" :value="template">{{template.name}}</option>
              </select>
              <p class="mt-2 text-sm text-gray-500" id="email-description">Select a template for this new entry</p>
            </div>

            <EntryEdit :entry="entry" :create="true" />


        </div>
    </PageContainer>
  </AppLayout>
</template>

<script setup>

//imports
import { ref, onMounted } from 'vue'
import { reactive, computed } from 'vue'

import AppLayout from "@/Layouts/AppLayout.vue";
import PageContainer from "@/Components/_util/PageContainer.vue";
import EntryEdit from "@/Components/entry/EntryEdit.vue";
import EntryHeaderCreate from "@/Components/entry/EntryHeaderCreate.vue";
import PrimaryButton from "@/Components/buttons/PrimaryButton.vue";

const props = defineProps(['new_entry', 'templates'])

// Templates
const selected_template = ref(props.templates[0]);

// Modify a new entry object based on the selected template
const entry = computed(() => {

  let current_template = selected_template.value
  props.new_entry.template = current_template

  let data = [];
  console.log(selected_template.value)

  // Populate the data with nulls
  for (var i = 0; i < current_template.fields.length; i++) {
    data[current_template.fields[i].id] = null;
  }

  // Attatch data
  props.new_entry['data'] = data;

  return props.new_entry
})


</script>
