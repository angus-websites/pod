<template>
  <div class="lg:flex lg:items-center lg:justify-between">
    <div class="min-w-0 flex-1">
      <Link :href="route('entries.index')" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700"><ChevronLeftIcon class="-ml-0.5 mr-1 h-4 w-4" aria-hidden="true" />Entries</Link>
      <Heading1>New Entry</Heading1>
      <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
        <div class="mt-2 flex items-center text-sm text-gray-500">
            Select a template and enter the details for this new entry
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import Heading1 from "@/Components/headings/Heading1.vue";
import { ChevronLeftIcon } from '@heroicons/vue/20/solid'

</script>
