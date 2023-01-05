<template>
  <div class="lg:flex lg:items-center lg:justify-between">
    <div class="min-w-0 flex-1">
      <nav class="flex" aria-label="Breadcrumb">
        <ol role="list" class="flex items-center space-x-4">
          <li>
            <div class="flex">
              <a href="#" class="text-sm font-medium text-gray-500 hover:text-gray-700">Home</a>
            </div>
          </li>
          <li>
            <div class="flex items-center">
              <ChevronRightIcon class="h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
              <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Entries</a>
            </div>
          </li>
        </ol>
      </nav>
      <h2 class="mt-2 text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
        {{ title}}
      </h2>
      <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
        <div class="mt-2 flex items-center text-sm text-gray-500">
          <CalendarIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
          {{ date }}
        </div>
      </div>
    </div>
    <div class="mt-5 flex lg:mt-0 lg:ml-4">
        <PrimaryButton>
            <PencilIcon class="-ml-1 mr-2 h-5 w-5" aria-hidden="true" />
            Edit
        </PrimaryButton>
    </div>
  </div>
</template>

<script setup>
import {
  CalendarIcon,
  ChevronRightIcon,
  PencilIcon,
} from '@heroicons/vue/20/solid'
import PrimaryButton from "@/Components/buttons/PrimaryButton.vue";

const props = defineProps({
    title: {
        type: String,
    },
    date: {
      type: String,
    },
    edit: {
        type: Boolean,
        default: false
    },
})

</script>
