
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
                <div class="mt-10 flex flex-col space-y-10">

                    <!-- Question group -->
                    <div v-for="(group, g) in feedbackGroups.data">

                        <div class="relative mb-10">
                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                <div class="w-full border-t border-gray-300" />
                            </div>
                            <div class="relative flex justify-center">
                                <span class="bg-white px-3 text-base font-semibold leading-6 text-gray-900">Section {{g+1}}</span>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg border p-5 pt-1">

                            <Heading2 class="m-0">{{ group.name }}</Heading2>
                            <small>{{ group.caption }}</small>

                            <!-- Questions -->
                            <div class="mt-5 flex flex-col space-y-5 md:max-w-lg">
                                <div v-for="(question, q) in group.questions">
                                    <Heading3><b>{{g+1}}.{{q+1}}</b> &nbsp; {{question.name}}</Heading3>

                                    <template v-if="question.type == 'text'">
                                        <div class="mt-2">
                                            <textarea rows="4" name="comment" id="comment" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                        </div>
                                    </template>

                                    <template v-else-if="question.type == 'radio'">
                                        <fieldset>
                                            <div class="mt-4 divide-y divide-gray-200 border-b border-t border-gray-200">
                                                <div v-for="(option, index) in question.data.options" :key="index" class="relative flex items-start py-4">
                                                    <div class="min-w-0 flex-1 text-sm leading-6">
                                                        <label :for="`side-${option.id}`" class="select-none font-medium text-gray-900">{{ option.label }}</label>
                                                    </div>
                                                    <div class="ml-3 flex h-6 items-center">
                                                        <input :id="`side-${option.id}`" :name="question.name" type="radio" :checked="option.id === null" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </template>
                                </div>
                            </div>
                        </div>
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
    feedbackGroups: Object,
})

</script>
