
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
                <div class="mt-6 flex flex-col space-y-20 md:max-w-xl">

                    <div v-for="group in feedbackGroups.data">
                        <Heading2>{{ group.name }}</Heading2>
                        <hr>

                        <!-- Questions -->
                        <template v-for="question in group.questions">
                            <Heading3>{{question.name}}</Heading3>

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
                                                <input :id="`side-${option.id}`" name="plan" type="radio" :checked="option.id === null" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </template>

                        </template>
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
