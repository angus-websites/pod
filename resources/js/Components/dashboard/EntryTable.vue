<template>
  <div v-if="entries.data.length > 0" class="overflow-hidden bg-white shadow sm:rounded-md border">
    <ul role="list" class="divide-y divide-gray-200">
      <li v-for="entry in entries.data" :key="entry.id">
        <Link :href="route('entries.show', entry.id)" class="block hover:bg-gray-50">
            <div class="flex items-center px-4 py-4 sm:px-6">
                <div class="flex min-w-0 flex-1 items-center">
                    <div>
                        <p class="truncate text-md font-medium text-secondary">{{ entry.title }}</p>
                        <p class="mt-2 flex items-center text-sm text-gray-500">
                            <img v-if="getTemplateIcon(entry.template)" :src="getTemplateIcon(entry.template)" alt="" aria-hidden="true" class="mr-1.5 h-4 w-4 flex-shrink-0 text-gray-400">
                            <span class="truncate">{{ getTemplateName(entry.template)}}</span>
                        </p>
                        <p class="mt-2 flex items-center text-sm text-gray-500 sm:hidden">
                            <small class="truncate">{{ entry.data.date }}</small>
                        </p>
                    </div>
                </div>
                <div class="sm:flex-1 hidden sm:block text-center">
                    <p class="text-sm text-gray-500">{{ entry.data.date }}</p>
                </div>
                <div>
                    <ChevronRightIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                </div>
            </div>
        </Link>
      </li>
    </ul>
  </div>
  <div v-else class="p-5 text-center">
    <h3 class="mt-2 text-sm font-semibold text-gray-900">No Entries found</h3>
    <p class="mt-1 text-sm text-gray-500">Get started by creating a new one.</p>
  </div>
</template>

<script setup>
import { CheckCircleIcon, ChevronRightIcon, DocumentTextIcon } from '@heroicons/vue/20/solid'

let $props = defineProps({
    entries: Object,
    templates: Array,
});

function getTemplateName(templateID){
  /**
   * Get the template for this entry
   */
  for (var i = 0; i < $props.templates.length; i++) {
    let t = $props.templates[i]
    if (t.id == templateID){
      return t.name
    }
  }
  return "No template";
}

function getTemplateIcon(templateID){
  /**
   * Get the icon for this entry
   */
  for (var i = 0; i < $props.templates.length; i++) {
    let t = $props.templates[i]
    if (t.id == templateID){
      return t.icon
    }
  }
  return "No template";
}
</script>
