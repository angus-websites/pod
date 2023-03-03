<template>
  <div class="px-4 sm:px-6 lg:px-8">

    <div class="sm:flex-auto">
        <h1 class="text-lg font-semibold leading-6 text-gray-900">Features</h1>
        <p class="mt-2 text-sm text-gray-700">All the features of the application</p>
    </div>

    <div class="mt-8 flow-root">
      <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
          <table class="min-w-full divide-y divide-gray-300">
            <thead>
              <tr>
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0"></th>
                <th v-for="group in featureGroups" scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">{{group.name}}</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              <tr v-for="feature in features" :key="feature.id">
                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ feature.name }}</td>
                <td v-for="group in featureGroups" class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">
                  <span v-if="featureInGroup(feature, group)" class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">True</span>
                  <span v-else class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800">False</span>
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
  const props = defineProps({
      featureGroups: Object,
      features: Object,
  })

  function featureInGroup(feature, group){
    /**
     * Check if a group contains a feature
     */
    for (var i = 0; i < group.features.length; i++) {
      let f = group.features[i]
      if (f.id == feature.id){
        return true
      }
    }
    return false
  }
</script>