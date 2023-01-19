
<template>
    <div class="flex flex-col space-y-5">

        <div class="flex flex-col md:flex-row md:space-x-8 space-y-5 md:space-y-0">
            
            
            <!-- Title input -->
            <div class="flex-1">
                <label for="email" class="block text-sm font-medium text-gray-700">Title</label>
                <div class="mt-1">
                  <input v-model.lazy="entry.title" type="text" name="title" id="title" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Just a normal day" />
                </div>
            </div>

            <!-- Date -->
            <div class="flex-1">
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                <div class="mt-1">
                  <input v-model.lazy="entry.date" type="date" name="date" id="date" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="01/01/2023" />
                </div>
            </div>
        </div>

        <!-- Entry content -->
        <div>
            <label for="content" class="block text-sm font-medium text-gray-700">Entry content</label>
            <div class="mt-1">
              <textarea v-model.lazy="entry.content" rows="4" name="content" id="content" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </textarea>
            </div>
        </div>

        <!-- Save button -->
        <div class="mt-5">
            <PrimaryButton>Save</PrimaryButton>
        </div>
    </div>
</template>


<script>

import PrimaryButton from "@/Components/buttons/PrimaryButton.vue";
export default {
    components: {
        PrimaryButton,
    },
    props: {
        entry: Object
    },
}
</script>
