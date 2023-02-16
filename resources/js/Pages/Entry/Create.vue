
<template>
  <AppLayout title="New Entry">
    <PageContainer>
        <div class="flex flex-col space-y-10">
            <EntryHeaderCreate />
            

            <!-- Template selection -->
            <div>
              <label for="template" class="block text-sm font-medium text-gray-700">Template</label>
              <select v-model="selected_template" id="template" class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                <option v-for="template in templates" :value="template">{{template.name}}</option>
              </select>
              <p class="mt-2 text-sm text-gray-500" id="email-description">{{selected_template.description}}</p>
            </div>

            <div class="relative">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                  <div class="w-full border-t border-gray-300" />
                </div>
                <div class="relative flex justify-center">
                  <span class="bg-white px-2 text-sm text-gray-500">{{selected_template.name}}</span>
                </div>
            </div>

            <EntryCreate :template="selected_template" />


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
import EntryCreate from "@/Components/entry/EntryCreate.vue";
import EntryHeaderCreate from "@/Components/entry/EntryHeaderCreate.vue";
import PrimaryButton from "@/Components/buttons/PrimaryButton.vue";

const props = defineProps(['new_entry', 'templates'])

// Templates
const selected_template = ref(props.templates[0]);

</script>
