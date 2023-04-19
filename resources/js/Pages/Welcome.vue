<template>
    <GuestLayout title="Home">
        <main class="mx-auto mt-16 max-w-7xl px-4 sm:mt-24">

            <!-- Intro -->
            <div class="text-center">
                <h1 class="text-4xl font-bold tracking-tight text-grey-900 sm:text-5xl md:text-6xl">
                    <span class="block xl:inline">Keep track of</span>
                    {{ ' ' }}
                    <span class="block text-[#4760C1] xl:inline">your placement year</span>
                </h1>
                <p class="mx-auto mt-3 max-w-md text-sm text-gray-500 sm:text-md md:mt-5 md:max-w-3xl md:text-xl">
                    With our user-friendly interface, you can easily log your daily tasks, accomplishments, and feedback during your placement year.

                </p>
                <div class="mx-auto mt-5 max-w-md sm:flex sm:justify-center md:mt-8">
                    <PrimaryButton size="l" :href="route('register')" :isLink=true class="w-full">
                        Get Started
                    </PrimaryButton>
                    <NeutralButton size="l" href="#learnMore" :isLink=true class="w-full mt-4 sm:mt-0 sm:ml-4">
                        Learn more
                    </NeutralButton>
                </div>
            </div>

            <div class="flex flex-col gap-y-24 mt-20">
                <!-- Tiny -->
                <div v-if="initialContent" class="text-center">
                    <TemplateRaw field="" v-model="initialContent" />
                    <small class="my-5">Feel free to mess around with our example editor above</small>
                </div>

                <div>
                    <div class="bg-white pb-24 sm:pb-32">
                        <div class="mx-auto max-w-7xl px-6 lg:px-8">
                            <div class="mx-auto max-w-2xl lg:text-center">
                                <h2 id="learnMore" class="text-base font-semibold leading-7 text-indigo-600">Work smarter</h2>
                                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Everything you need to remember your placement year</p>
                                <p class="mt-6 text-md leading-6 text-gray-500">
                                    Our website is not only useful during the placement, but also after the placement when it's time to update your resume or prepare for job interviews. With all your placement data in one place, you can easily retrieve the information and showcase your achievements to potential employers.
                                </p>
                            </div>
                            <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                                <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
                                    <div v-for="feature in features" :key="feature.name" class="flex flex-col text-center">
                                        <dt class="flex items-center gap-x-3 mx-auto text-base font-semibold leading-7 text-gray-900">
                                            <component :is="feature.icon" class="h-5 w-5 flex-none text-indigo-600" aria-hidden="true" />
                                            {{ feature.name }}
                                        </dt>
                                        <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
                                            <p class="flex-auto">{{ feature.description }}</p>
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import PrimaryButton from "@/Components/buttons/PrimaryButton.vue";
import NeutralButton from "@/Components/buttons/NeutralButton.vue";
import TemplateRaw from "@/Components/template/TemplateRaw.vue";

import {ArrowPathIcon} from '@heroicons/vue/20/solid'
import {DocumentMagnifyingGlassIcon, PencilSquareIcon} from '@heroicons/vue/24/outline'

const features = [
    {
        name: 'Rich-text Entries',
        description:
            'Make your entry look the way you want with our modern WYSIWYG editor',
        icon: PencilSquareIcon,
    },
    {
        name: 'CV Generation',
        description:
            'Generate a personalised CV in a single click using the data from your diary',
        icon: ArrowPathIcon,
    },
    {
        name: 'Quick Retrieval',
        description:
            'Find past entries in lightning speed using real time search, filtering and sorting',
        icon: DocumentMagnifyingGlassIcon,
    },
]
const props = defineProps({
    initialContent: String
});

</script>
