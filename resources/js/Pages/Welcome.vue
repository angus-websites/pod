<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PageContainer from "@/Components/Util/PageContainer.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <GuestLayout title="Welcome">
        <PageContainer>

            <div class="relative">
              <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
              </div>
              <input datepicker type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input" placeholder="Select date">
            </div>

            <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
                    <div class="grid row-gap-8 sm:row-gap-0 sm:grid-cols-2 lg:grid-cols-3">
                        <div class="p-8 border-b sm:border-r">
                            <div class="max-w-md text-center">
                                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full bg-indigo-50 sm:w-16 sm:h-16">
                                    <svg class="w-8 h-8 text-deep-purple-accent-400 sm:w-12 sm:h-12" stroke="currentColor" viewBox="0 0 52 52">
                                        <polygon stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none" points="29 13 14 29 25 29 23 39 38 23 27 23"></polygon>
                                    </svg>
                                </div>
                                <h6 class="mb-2 font-semibold leading-5">The quick fox</h6>
                                <p class="mb-3 text-sm text-gray-900">
                                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium rem aperiam, eaque ipsa quae. Sit error voluptatem.
                                </p>
                            </div>
                        </div>
                        <div class="p-8 border-b lg:border-r">
                            <div class="max-w-md text-center">
                                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full bg-indigo-50 sm:w-16 sm:h-16">
                                    <svg class="w-8 h-8 text-deep-purple-accent-400 sm:w-12 sm:h-12" stroke="currentColor" viewBox="0 0 52 52">
                                        <polygon stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none" points="29 13 14 29 25 29 23 39 38 23 27 23"></polygon>
                                    </svg>
                                </div>
                                <h6 class="mb-2 font-semibold leading-5">Leverage agile</h6>
                                <p class="mb-3 text-sm text-gray-900">
                                    Storage shed, troughs feed bale manure, is garden wheat oats at augers. Bulls at rose garden cucumbers mice sunflower wheat in pig.
                                </p>
                            </div>
                        </div>
                        <div class="p-8 border-b sm:border-r lg:border-r-0">
                            <div class="max-w-md text-center">
                                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full bg-indigo-50 sm:w-16 sm:h-16">
                                    <svg class="w-8 h-8 text-deep-purple-accent-400 sm:w-12 sm:h-12" stroke="currentColor" viewBox="0 0 52 52">
                                        <polygon stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none" points="29 13 14 29 25 29 23 39 38 23 27 23"></polygon>
                                    </svg>
                                </div>
                                <h6 class="mb-2 font-semibold leading-5">Organically grow</h6>
                                <p class="mb-3 text-sm text-gray-900">
                                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium rem aperiam, eaque ipsa quae. Sit error voluptatem.
                                </p>
                            </div>
                        </div>
                        <div class="p-8 border-b lg:border-b-0 lg:border-r">
                            <div class="max-w-md text-center">
                                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full bg-indigo-50 sm:w-16 sm:h-16">
                                    <svg class="w-8 h-8 text-deep-purple-accent-400 sm:w-12 sm:h-12" stroke="currentColor" viewBox="0 0 52 52">
                                        <polygon stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none" points="29 13 14 29 25 29 23 39 38 23 27 23"></polygon>
                                    </svg>
                                </div>
                                <h6 class="mb-2 font-semibold leading-5">Have a good one</h6>
                                <p class="mb-3 text-sm text-gray-900">
                                    Storage shed, troughs feed bale manure, is garden wheat oats at augers. Bulls at rose garden cucumbers mice sunflower wheat in pig.
                                </p>
                            </div>
                        </div>
                        <div class="p-8 border-b sm:border-b-0 sm:border-r">
                            <div class="max-w-md text-center">
                                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full bg-indigo-50 sm:w-16 sm:h-16">
                                    <svg class="w-8 h-8 text-deep-purple-accent-400 sm:w-12 sm:h-12" stroke="currentColor" viewBox="0 0 52 52">
                                        <polygon stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none" points="29 13 14 29 25 29 23 39 38 23 27 23"></polygon>
                                    </svg>
                                </div>
                                <h6 class="mb-2 font-semibold leading-5">Trough pomfret</h6>
                                <p class="mb-3 text-sm text-gray-900">
                                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium rem aperiam, eaque ipsa quae. Sit error voluptatem.
                                </p>
                            </div>
                        </div>
                        <div class="p-8">
                            <div class="max-w-md text-center">
                                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full bg-indigo-50 sm:w-16 sm:h-16">
                                    <svg class="w-8 h-8 text-deep-purple-accent-400 sm:w-12 sm:h-12" stroke="currentColor" viewBox="0 0 52 52">
                                        <polygon stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none" points="29 13 14 29 25 29 23 39 38 23 27 23"></polygon>
                                    </svg>
                                </div>
                                <h6 class="mb-2 font-semibold leading-5">Disrupt inspire</h6>
                                <p class="mb-3 text-sm text-gray-900">
                                    Storage shed, troughs feed bale manure, is garden wheat oats at augers. Bulls at rose garden cucumbers mice sunflower wheat in pig.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
        </PageContainer>
    </GuestLayout>
</template>
