
<template>
    <AppLayout title="Feedback">
        <PageContainer>
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col gap-y-10">

                    <div>
                        <Heading1>
                            Generate a CV <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800">Early access</span>
                        </Heading1>
                        <p class="mt-1 sm:mt-2 text-sm text-gray-700">Here you can generate a CSV based on the content of your entries</p>
                        <hr class="my-5">
                    </div>

                    <!-- Generate button -->
                    <div class="text-center">
                        <PrimaryButton @click="generate" :disabled="loading">
                            Generate
                        </PrimaryButton>
                    </div>

                    <!-- Loading screen -->
                    <div class="flex justify-center" v-if="loading">
                        <RingLoader class=""></RingLoader>
                    </div>

                    <!-- Rendered content -->
                    <div class="border p-5 shadow" v-if="data && !loading">
                        <article class="prose" v-html="data.content">
                        </article>
                    </div>
                </div>

            </div>
        </PageContainer>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import PageContainer from "@/Components/_util/PageContainer.vue";
import PrimaryButton from "@/Components/buttons/PrimaryButton.vue";
import Heading1 from "@/Components/headings/Heading1.vue";
import {Inertia} from "@inertiajs/inertia";
import RingLoader from 'vue-spinner/src/RingLoader.vue'
import {ref} from "vue";

const props = defineProps({
    data: Object,
})

// Vars
let loading = ref(false);

function generate(){
    Inertia.reload({
        only: ['data'],
        onStart: (visit) => {
            loading.value=true;
        },
        onFinish: (visit) =>{
            loading.value=false
        }
    })
}

</script>
