
<template>
    <AppLayout title="Feedback">
        <PageContainer>
            <div class="px-4 sm:px-6 lg:px-8">
                <div>
                    <Heading1>Review Feedback</Heading1>
                    <p class="mt-1 sm:mt-2 text-sm text-gray-700">Here you can review the feedback about the application</p>
                    <hr class="my-5">
                </div>
                <div class="mt-10 flex flex-col space-y-10">
                    <!-- Question group -->
                    <div v-for="(group, g) in feedback.data">

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
                            <div class="mt-5 flex flex-col space-y-5">

                                <div v-if="group.questions.length < 1">
                                    No questions for this section
                                </div>
                                <div v-else v-for="(question, q) in group.questions">
                                    <Heading3><b>{{g+1}}.{{q+1}}</b> &nbsp; {{question.name}}</Heading3>
                                    <small v-if="question.caption">{{question.caption}}</small>

                                    <ReviewTable :answers="question.answers" />

                                </div>
                            </div>
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
import {reactive, onBeforeMount} from 'vue'
import {useForm} from '@inertiajs/inertia-vue3';
import ReviewTable from "@/Components/feedback/ReviewTable.vue";

const props = defineProps({
    feedback: Object,
})



</script>
