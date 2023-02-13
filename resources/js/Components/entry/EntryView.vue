
<template>

    <div class="flex flex-col space-y-5">

      <div v-for="item in entry.data">
        {{ item }}
      </div>
    </div>

<!--     <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
      <div class="mt-2 flex items-center text-sm text-gray-500">
        <CalendarIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
        {{ entry.date }}
      </div>
    </div>

    <article class="prose prose-zinc" v-html="entry.content">
    </article> -->
</template>


<script setup>
import {
  CalendarIcon,
} from '@heroicons/vue/20/solid'

const props = defineProps({
    entry: {
        type: Object,
    }
})
</script>
