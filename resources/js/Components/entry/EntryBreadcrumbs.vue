<template>
  <nav class="flex" aria-label="Breadcrumb">
    <ol role="list" class="flex items-center space-x-4">
      <li>
        <div class="flex">
          <Link :href="route('entries.index')" class="text-sm font-medium text-gray-500 hover:text-gray-700">Entries</Link>
        </div>
      </li>
      <li>
        <div class="flex items-center">
          <ChevronRightIcon class="h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
          <span class="ml-4 text-sm font-medium text-gray-500">{{ title }}</span>
        </div>
      </li>
    </ol>
  </nav>
</template>

<script setup>
import {
  ChevronRightIcon,
} from '@heroicons/vue/20/solid'

const props = defineProps({
    title: {
        type: String,
    }
})

</script>
