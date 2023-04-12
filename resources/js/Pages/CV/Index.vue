
<template>
    <AppLayout title="CV">

        <PageContainer>
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col gap-y-10">

                    <div>
                        <Heading1>
                            Generate a CV <span class="inline-flex items-center rounded-full bg-orange-200 px-2.5 py-0.5 text-xs font-medium text-orange-800">Early access</span>
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
                    <div class="flex flex-col justify-center gap-y-5" v-if="data && !loading">

                        <!-- Download button -->
                        <div class="text-center">
                            <a :href="route('cv.download', { cvContent: cvContent })"
                               class="inline-flex items-center gap-x-1.5 rounded-md bg-secondary px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-secondary-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 ">
                                Download
                                <ArrowDownTrayIcon class="-mr-0.5 h-5 w-5" aria-hidden="true" />
                            </a>
                        </div>

                        <Editor
                            v-model="cvContent"
                            @selectionChange="handlerFunction"
                            api-key="ljfuynz3a61fqanmksvqwvil07uc83jbc1ntm6pk31w1n78g"
                            :init="{
                                branding: false,
                                menubar: false,
                                min_height: 300,
                                height: 800,
                                plugins: [
                                'autolink lists link wordcount'
                                ],
                            }"
                        />
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
import {ref, reactive} from "vue";
import Editor from '@tinymce/tinymce-vue'
import { ArrowDownTrayIcon } from '@heroicons/vue/20/solid'

const props = defineProps({
    data: Object,
})

// Vars
let loading = ref(false);
let cvContent = ref("");

function generate(){
    Inertia.reload({
        only: ['data'],
        onStart: (visit) => {
            loading.value=true;
        },
        onFinish: (visit) =>{
            loading.value=false
            cvContent.value = props.data.content
        }
    })

}

</script>
