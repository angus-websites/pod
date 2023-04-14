
<template>
    <AppLayout title="Feedback">
        <PageContainer>
            <div class="px-4 sm:px-6 lg:px-8">
                <div>
                    <Heading1>Feedback</Heading1>
                    <p class="mt-1 sm:mt-2 text-sm text-gray-700">Here you can submit feedback about the application</p>
                    <hr class="my-5">
                </div>

                <!-- Main container -->
                <div class="mt-6 flex flex-col space-y-20">
                    <div>
                        <Heading2>General</Heading2>
                        <hr>
                    </div>

                    <div v-if="features.data.length > 0">
                        <Heading2>Features</Heading2>
                        <hr>
                        <div class="mt-6 flex flex-col space-y-10">
                            <fieldset v-for="feature in features.data">
                                <Heading3>
                                    {{ feature.name.charAt(0).toUpperCase() + feature.name.slice(1) }}
                                </Heading3>
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
                    </div>
                </div>
            </div>
        </PageContainer>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import PageContainer from "@/Components/_util/PageContainer.vue";
import Heading1 from "@/Components/headings/Heading1.vue";
import PrimaryButton from "@/Components/buttons/PrimaryButton.vue";
import Heading2 from "@/Components/headings/Heading2.vue";
import Heading3 from "@/Components/headings/Heading3.vue";

const props = defineProps({
    features: Object,
})

</script>
