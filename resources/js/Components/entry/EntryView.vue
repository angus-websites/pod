
<template>

    <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
      <dl class="sm:divide-y sm:divide-gray-200">
        <div v-for="item in template.fields" class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">{{item.label}}</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{entry.data[item.id]}}</dd>
        </div>
      </dl>
    </div>
</template>


<script setup>
import {
  CalendarIcon,
} from '@heroicons/vue/20/solid'

const props = defineProps({
    entry: {
        type: Object,
    },
    template: {
      type: Object
    }
})
</script>
