
<template>
    <AppLayout title="Feedback">
        <PageContainer>
            <div class="px-4 sm:px-6 lg:px-8">
                <div>
                    <Heading1>Review Feedback</Heading1>
                    <p class="mt-1 sm:mt-2 text-sm text-gray-700">Here you can review the feedback about the application</p>
                    <hr class="my-5">
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

const props = defineProps({
    feedback: Object,
})



</script>
