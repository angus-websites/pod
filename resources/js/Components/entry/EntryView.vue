
<template>

    <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
        <dl class="divide-y divide-gray-100">
            <template v-for="item in template.fields">
                <div v-if="item.type == 'raw'" class="border-t border-gray-100 px-4 py-6 sm:col-span-2 sm:px-0">
                    <dd class="mt-5 text-sm leading-6 text-gray-700 sm:mt-2">
                        <div class="prose prose-stone" v-html="entry.data[item.id]">
                        </div>
                    </dd>
                </div>
                <div v-else class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">
                        {{item.label}}
                    </dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        {{entry.data[item.id]}}
                    </dd>
                </div>
            </template>
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
