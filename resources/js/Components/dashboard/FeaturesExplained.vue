<template>
  <div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex-auto">
        <h2 class="text-lg font-semibold leading-6 text-gray-900">Features</h2>
        <p class="mt-2 text-sm text-gray-700">An explanation of the features in the application</p>
    </div>
    <div class="mt-8 flow-root">
      <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
          <table class="min-w-full divide-y divide-gray-300">
            <thead>
              <tr>
                <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500 sm:pl-0">Name</th>
                <th scope="col" class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">Description</th>
                <th scope="col" class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">Active?</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
              <tr v-for="feature in features" :key="feature.id">
                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ feature.name }}</td>
                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">{{ feature.description }}</td>
                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">
                  <span v-if="isFeatureActive(feature)" class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">
                    <CheckIcon class="h-5 w-5" aria-hidden="true" />
                  </span>
                  <span v-else class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800"><XMarkIcon class="h-5 w-5" aria-hidden="true"/></span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
  import { CheckIcon } from '@heroicons/vue/20/solid'
  import { XMarkIcon } from '@heroicons/vue/20/solid'
  
  const props = defineProps({
      features: Object
  })

  function isFeatureActive(feature){
    if (feature.active === true){
      return true
    }
  }
</script>