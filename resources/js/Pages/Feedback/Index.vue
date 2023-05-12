
<template>
    <AppLayout title="Feedback">
        <PageContainer>
            <div class="px-4 sm:px-6 lg:px-8">
                <div>
                    <Heading1>Feedback</Heading1>
                    <p class="mt-1 sm:mt-2 text-sm text-gray-700">Here you can submit completely <u>anonymous</u> feedback about the application (all questions are optional)</p>
                    <hr class="my-5">
                </div>

                <div v-if="canReviewFeedback">
                    <SecondaryButton :isLink="true" :href="route('feedback.review')">Review Feedback</SecondaryButton>
                </div>

                <form @submit.prevent="submit">
                    <!-- Main container -->
                    <div class="mt-10 flex flex-col space-y-10">

                        <template v-if="feedbackGroups.data.length > 0">
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

                                        <div v-if="group.questions.length < 1">
                                            No questions for this section
                                        </div>
                                        <div v-else v-for="(question, q) in group.questions">
                                            <Heading3><b>{{g+1}}.{{q+1}}</b> &nbsp; {{question.name}}</Heading3>
                                            <small v-if="question.caption">{{question.caption}}</small>

                                            <template v-if="question.type == 'text'">
                                                <div class="mt-2">
                                                    <textarea v-model="feedback.answers[question.id]" rows="4" name="comment" id="comment" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
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
                                                                <input v-model="feedback.answers[question.id]" :value="option.id" :id="`side-${option.id}`" :name="question.name" type="radio" class="h-4 w-4 border-gray-300 text-primary focus:ring-primary-600" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </template>

                                            <template v-if="$page.props.errors">
                                                <p v-if="$page.props.errors[question.id]" class="mt-2 text-sm text-red-600">{{ $page.props.errors[question.id] }}</p>
                                            </template>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Submit -->
                             <div class="mt-10">
                                 <PrimaryButton :disabled="form.processing">Submit</PrimaryButton>
                             </div>
                        </template>
                        <div v-else>
                            <p>No feedback questions available, please check back later</p>
                        </div>
                    </div>
                </form>
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
import {reactive, onBeforeMount} from 'vue'
import {useForm, usePage} from '@inertiajs/inertia-vue3';
import SecondaryButton from "@/Components/buttons/SecondaryButton.vue";

const canReviewFeedback = usePage().props.value.canReviewFeedback


const props = defineProps({
    feedbackGroups: Object,
})

// Initiate an object to store the feedback in
let feedback = reactive({
    "answers": {}
})

// We need to run before the UI is rendered
onBeforeMount(() => {
    setupForm()
})


const form = useForm({
    feedback: feedback,
})

function submit()
{
    /**
     * Submit the form to backend
     */
    form.post(route('feedback.submit'), {
        onSuccess: () => setupForm(),
    })
}

function setupForm(){
    // When we mount, construct an object to store feedback in
    for (const groupKey in props.feedbackGroups["data"]) {
        const currentGroup = props.feedbackGroups["data"][groupKey]
        for (const questionKey in currentGroup.questions) {
            const currentQuestion = currentGroup.questions[questionKey]
            feedback["answers"][currentQuestion.id] = ""
        }
    }
}

</script>
