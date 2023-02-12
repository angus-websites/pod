
<template>
  <AppLayout title="New Entry">
    <PageContainer>
        <div class="flex flex-col space-y-5">
            <EntryHeaderCreate />
            

            <!-- Template selection -->
            <div>
              <label for="location" class="block text-sm font-medium text-gray-700">Template</label>
              <select v-model="selected_template" class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                <option v-for="template in templates" :value="template">{{template.name}}</option>
              </select>
            </div>

            <!-- Render -->
            <p>Current template: {{selected_template.name}} </p>

            <form class="flex flex-col space-y-5">
              <div v-for="field in selected_template.fields">
                <label :for="field.id">{{field.label}}</label>
                <input v-if="field.type == 'text'" type="text" :name="field.id" :id="field.id">
                <input v-if="field.type == 'date'" type="date" :name="field.id" :id="field.id">
                <textarea v-else-if="field.type == 'textarea'" :name="field.id" :id="field.id"></textarea>
              </div>
            </form>


        </div>
    </PageContainer>
  </AppLayout>
</template>

<script setup>

//imports
import { ref, onMounted } from 'vue'
import AppLayout from "@/Layouts/AppLayout.vue";
import PageContainer from "@/Components/_util/PageContainer.vue";
import EntryEdit from "@/Components/entry/EntryEdit.vue";
import EntryHeaderCreate from "@/Components/entry/EntryHeaderCreate.vue";

const props = defineProps(['new_entry', 'templates'])

// Templates
const selected_template = ref(props.templates[0]);



</script>
