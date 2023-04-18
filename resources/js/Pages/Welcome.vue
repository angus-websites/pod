<template>
    <GuestLayout title="Home">
        <main class="mx-auto mt-16 max-w-7xl px-4 sm:mt-24">
            <div class="text-center">
                <h1 class="text-4xl font-bold tracking-tight text-grey-900 sm:text-5xl md:text-6xl">
                    <span class="block xl:inline">Keep track of</span>
                    {{ ' ' }}
                    <span class="block text-[#4760C1] xl:inline">your placement year</span>
                </h1>
                <p class="mx-auto mt-3 max-w-md text-sm text-gray-500 sm:text-md md:mt-5 md:max-w-3xl md:text-xl">Make sure you don't forget anything you did on your placement year, record skills, training or anything you want</p>
                <div class="mx-auto mt-5 max-w-md sm:flex sm:justify-center md:mt-8">
                    <PrimaryButton size="l" :href="route('register')" :isLink=true class="w-full">
                        Get Started
                    </PrimaryButton>
                    <NeutralButton size="l" href="#" :isLink=true class="w-full mt-4 sm:mt-0 sm:ml-4">
                        Learn more
                    </NeutralButton>
                </div>
            </div>

            <div class="flex flex-col gap-y-20 mt-20">
                <!-- Tiny -->
                <div>
                    <TemplateRaw field="" v-model="initialContent" />
                </div>

                <div>
                    <!-- Heading -->
                    <div class="mx-auto max-w-2xl sm:text-center">
                        <h2 class="text-base font-semibold leading-7 text-indigo-600">Everything you need</h2>
                        <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">No server? No problem.</p>
                        <p class="mt-6 text-lg leading-8 text-gray-600">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores impedit perferendis suscipit eaque, iste dolor cupiditate blanditiis.</p>
                    </div>

                    <!-- Features -->
                    <div class="mx-auto mt-16 max-w-7xl px-6 sm:mt-20 md:mt-24 lg:px-8">
                        <dl class="mx-auto grid max-w-2xl grid-cols-1 gap-x-6 gap-y-10 text-base leading-7 text-gray-600 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-3 lg:gap-x-8 lg:gap-y-16">
                            <div v-for="feature in features" :key="feature.name" class="relative pl-9">
                                <dt class="inline font-semibold text-gray-900">
                                    <component :is="feature.icon" class="absolute left-1 top-1 h-5 w-5 text-indigo-600" aria-hidden="true" />
                                    {{ feature.name }}
                                </dt>
                                {{ ' ' }}
                                <dd class="inline">{{ feature.description }}</dd>
                            </div>
                        </dl>
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

import {
    ArrowPathIcon,
    CloudArrowUpIcon,
    Cog6ToothIcon,
    FingerPrintIcon,
    LockClosedIcon,
    ServerIcon,
} from '@heroicons/vue/20/solid'

const features = [


    {
        name: 'Push to deploy.',
        description: 'Lorem ipsum, dolor sit amet consectetur adipisicing elit aute id magna.',
        icon: CloudArrowUpIcon,
    },
    {
        name: 'SSL certificates.',
        description: 'Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo.',
        icon: LockClosedIcon,
    },
    {
        name: 'Simple queues.',
        description: 'Ac tincidunt sapien vehicula erat auctor pellentesque rhoncus.',
        icon: ArrowPathIcon,
    },
    {
        name: 'Advanced security.',
        description: 'Lorem ipsum, dolor sit amet consectetur adipisicing elit aute id magna.',
        icon: FingerPrintIcon,
    },
    {
        name: 'Powerful API.',
        description: 'Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo.',
        icon: Cog6ToothIcon,
    },
    {
        name: 'Database backups.',
        description: 'Ac tincidunt sapien vehicula erat auctor pellentesque rhoncus. ',
        icon: ServerIcon,
    },
]

const props = defineProps({
    initialContent: String
});

</script>
