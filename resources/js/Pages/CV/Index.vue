
<template>
    <AppLayout title="Feedback">
        <PageContainer>
            <div class="px-4 sm:px-6 lg:px-8">
                <p class="text-xl font-bold text-gray-900 sm:text-2xl">Generate a CV</p>
                <p class="text-sm font-medium text-gray-600">Here you can generate a CSV based on the content of your entries</p>
                <hr class="my-5">
                <PrimaryButton @click="generate">
                    Generate
                </PrimaryButton>

                <div class="mt-5" v-if="data">
                    <article class="prose lg:prose-xl" v-html="data.content">
                    </article>
                </div>

            </div>
        </PageContainer>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import PageContainer from "@/Components/_util/PageContainer.vue";
import PrimaryButton from "@/Components/buttons/PrimaryButton.vue";
import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
    data: Object,
})

function generate(){
    Inertia.reload({ only: ['data'] })
}

</script>
