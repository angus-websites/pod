
<template>
    <AppLayout title="Feedback">
        <PageContainer>
            <div class="px-4 sm:px-6 lg:px-8">
             <p class="text-sm font-medium text-gray-600">Submit feedback</p>
             <p class="text-xl font-bold text-gray-900 sm:text-2xl">Submit feedback</p>
             <hr class="my-5">

             <fieldset class="mt-6">
                 <legend class="contents text-sm font-semibold leading-6 text-gray-900">How would you rate this app?</legend>
                 <p class="text-sm text-gray-500">Please select an option</p>
                 <div class="mt-4 space-y-4">
                   <div class="flex items-center">
                     <input id="great" name="rating" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                     <label for="great" class="ml-3 block text-sm font-medium leading-6 text-gray-900">Great</label>
                   </div>
                   <div class="flex items-center">
                     <input id="alright" name="rating" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                     <label for="alright" class="ml-3 block text-sm font-medium leading-6 text-gray-900">Alright</label>
                   </div>
                   <div class="flex items-center">
                     <input id="terrible" name="rating" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                     <label for="terrible" class="ml-3 block text-sm font-medium leading-6 text-gray-900">Terrible</label>
                   </div>
                 </div>
            </fieldset>
            
            </div>
        </PageContainer>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import PageContainer from "@/Components/_util/PageContainer.vue";
import Heading1 from "@/Components/headings/Heading1.vue";
import PrimaryButton from "@/Components/buttons/PrimaryButton.vue";

</script>