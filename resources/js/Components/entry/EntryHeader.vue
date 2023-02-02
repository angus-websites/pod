<template>
  <div class="lg:flex lg:items-center lg:justify-between">
    <div class="min-w-0 flex-1">
      <EntryBreadcrumbs :title="title" />
      <Heading1 :text="title" />
      <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
        <div class="mt-2 flex items-center text-sm text-gray-500">
          <CalendarIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
          {{ date }}
        </div>
      </div>
    </div>
    <div class="mt-5 flex lg:mt-0 lg:ml-4">
    </div>
  </div>
</template>

<script setup>
import {
  CalendarIcon,
} from '@heroicons/vue/20/solid'
import EntryBreadcrumbs from "@/Components/entry/EntryBreadcrumbs.vue";
import Heading1 from "@/Components/headings/Heading1.vue";
const props = defineProps({
    title: {
        type: String,
    },
    date: {
      type: String,
    }
})

</script>
