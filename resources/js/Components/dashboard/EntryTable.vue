<template>
  <div class="overflow-hidden bg-white shadow sm:rounded-md">
    <ul role="list" class="divide-y divide-gray-200">
      <li v-for="entry in entries.data" :key="entry.id">
        <Link :href="route('entries.show', entry.id)" class="block hover:bg-gray-50">
          <div class="flex items-center px-4 py-4 sm:px-6">
            <div class="flex min-w-0 flex-1 items-center">
              <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-gray-500">
                 <span class="font-medium leading-none text-white">A</span>
               </span>
              <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                <div>
                  <p class="truncate text-sm font-medium text-indigo-600">{{ entry.title }}</p>
                  <p class="mt-2 flex items-center text-sm text-gray-500">
                    <DocumentTextIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                    <span class="truncate">{{ entry.template.name }}</span>
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
</template>

<script setup>
import { CheckCircleIcon, ChevronRightIcon, DocumentTextIcon } from '@heroicons/vue/20/solid'

defineProps({
    entries: Object,

});
</script>