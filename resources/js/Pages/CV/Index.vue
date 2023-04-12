
<template>
    <AppLayout title="CV">

        <!-- Banner -->
        <div class="flex justify-center bg-yellow-300 py-2.5 px-6 sm:px-3.5">
            <div class="text-center text-sm font-medium flex flex-col gap-y-2 md:flex-row md:gap-x-2 items-center">
                <p><span class="inline-flex items-center rounded-full bg-white px-2.5 py-0.5 text-xs font-medium text-yellow-900">Early access</span></p>
                <p class="text-yellow-900">This is a new feature, you may experience some bugs</p>
            </div>
        </div>

        <PageContainer>
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col gap-y-10">
                    <div>
                        <Heading1>
                            Generate a CV <span class="inline-flex items-center rounded-full bg-yellow-300 px-2.5 py-0.5 text-xs font-medium text-yellow-900">Early access</span>
                        </Heading1>
                        <p class="mt-1 sm:mt-2 text-sm text-gray-700">Here you can generate a CSV based on the content of your entries</p>
                        <hr class="my-5">
                    </div>

                    <template v-if="numberOfEntries < minEntries">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-semibold text-gray-900">You cannot generate a CV</h3>
                            <p class="mt-1 text-sm text-gray-500">You need to have at least <b>{{minEntries}}</b> entries to generate a CV </p>
                            <div class="mt-6">
                                <PrimaryButton :isLink="true" :href="route('entries.create')">New Entry</PrimaryButton>
                            </div>
                        </div>
                    </template>

                    <template v-else>
                        <!-- Generate button -->
                        <div class="text-center">
                            <div>
                                <PrimaryButton @click="generate" :disabled="loading">
                                Generate
                                </PrimaryButton>
                            </div>
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
                    </template>
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
    numberOfEntries: Number,
    minEntries: Number
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
