<template>
  <div v-if="entries.data.length > 0" class="overflow-hidden bg-white shadow sm:rounded-md border">
    <ul role="list" class="divide-y divide-gray-200">
      <li v-for="entry in entries.data" :key="entry.id">
        <Link :href="route('entries.show', entry.id)" class="block hover:bg-gray-50">
          <div class="flex items-center px-4 py-4 sm:px-6">
            <div class="flex min-w-0 flex-1 items-center">
              <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-gray-500 text-white">
                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                   <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.148 2.148A12.061 12.061 0 0116.5 7.605" />
                 </svg>
               </span>
              <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                <div>
                  <p class="truncate text-sm font-medium text-indigo-600">{{ entry.title }}</p>
                  <p class="mt-2 flex items-center text-sm text-gray-500">
                    <span class="truncate">{{ getTemplateName(entry.template)}}</span>
                  </p>
                </div>
              </div>
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
    console.log(t)
    if (t.id == templateID){
      return t.name
    }
  }
  return "No template";
}
</script>