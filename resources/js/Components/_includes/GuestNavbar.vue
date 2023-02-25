<template>
    <Popover class="relative bg-white">
        <div class="flex items-center justify-between px-4 py-6 sm:px-6 md:justify-start md:space-x-10">
            <div class="flex justify-start lg:w-0 lg:flex-1">
                <a href="#">
                    <span class="sr-only">Your Company</span>
                    <TextLogo class="h-8" />
                </a>
            </div>
            <div class="-my-2 -mr-2 md:hidden">
                <PopoverButton class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-emerald-500">
                    <span class="sr-only">Open menu</span>
                    <Bars3Icon class="h-6 w-6" aria-hidden="true" />
                </PopoverButton>
            </div>
            <div v-if="$page.props.auth.user" class="hidden items-center justify-end md:flex md:flex-1 lg:w-0">
                <NeutralButton :isLink="true" :href="route('dashboard')">
                    Dashboard
                </NeutralButton>
            </div>
            <div v-else class="hidden items-center justify-end md:flex md:flex-1 lg:w-0">
                <NeutralButton :isLink="true" :href="route('login')">
                    Log in
                </NeutralButton>
                <PrimaryButton class="ml-4" :href="route('register')" :isLink="true">
                    Sign up
                </PrimaryButton>
            </div>
        </div>

        <transition enter-active-class="duration-200 ease-out" enter-from-class="opacity-0 scale-95" enter-to-class="opacity-100 scale-100" leave-active-class="duration-100 ease-in" leave-from-class="opacity-100 scale-100" leave-to-class="opacity-0 scale-95">
            <PopoverPanel focus class="absolute inset-x-0 top-0 origin-top-right transform p-2 transition md:hidden">
                <div class="divide-y-2 divide-gray-50 rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5">
                    <div class="py-6 px-5">
                        <div class="mt-6">
                            <div v-if="$page.props.auth.user">
                                <Link :href="route('dashboard')" class="flex w-full items-center justify-center rounded-md border border-transparent bg-primary px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-primary-600">Dashboard</Link>
                            </div>
                            <div v-else>

                                <Link :href="route('register')" class="flex w-full items-center justify-center rounded-md border border-transparent bg-primary px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-primary-600">Sign up</Link>
                                <p class="mt-6 text-center text-base font-medium text-gray-500">
                                    Existing customer?
                                    {{ ' ' }}
                                    <Link :href="route('login')" class="text-primary hover:text-primary-600">Sign in</Link>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </PopoverPanel>
        </transition>
    </Popover>
</template>

<script setup>
import { Popover, PopoverButton, PopoverGroup, PopoverPanel } from '@headlessui/vue'
import {
    ArrowPathIcon,
    Bars3Icon,
    ChartBarIcon,
    CursorArrowRaysIcon,
    DocumentChartBarIcon,
    ShieldCheckIcon,
    Squares2X2Icon,
    XMarkIcon,
} from '@heroicons/vue/24/outline'
import { ChevronDownIcon } from '@heroicons/vue/20/solid'
import TextLogo from "./TextLogo.vue";
import PrimaryButton from "@/Components/buttons/PrimaryButton.vue";
import NeutralButton from "@/Components/buttons/NeutralButton.vue";

const solutions = [
    {
        name: 'Analytics',
        description: 'Get a better understanding of where your traffic is coming from.',
        href: '#',
        icon: ChartBarIcon,
    },
    {
        name: 'Engagement',
        description: 'Speak directly to your customers in a more meaningful way.',
        href: '#',
        icon: CursorArrowRaysIcon,
    },
    { name: 'Security', description: "Your customers' data will be safe and secure.", href: '#', icon: ShieldCheckIcon },
    {
        name: 'Integrations',
        description: "Connect with third-party tools that you're already using.",
        href: '#',
        icon: Squares2X2Icon,
    },
    {
        name: 'Automations',
        description: 'Build strategic funnels that will drive your customers to convert',
        href: '#',
        icon: ArrowPathIcon,
    },
    {
        name: 'Reports',
        description: 'Get detailed reports that will help you make more informed decisions ',
        href: '#',
        icon: DocumentChartBarIcon,
    },
]
const resources = [
    {
        name: 'Help Center',
        description: 'Get all of your questions answered in our forums or contact support.',
        href: '#',
    },
    { name: 'Guides', description: 'Learn how to maximize our platform to get the most out of it.', href: '#' },
    { name: 'Events', description: 'See what meet-ups and other events we might be planning near you.', href: '#' },
    { name: 'Security', description: 'Understand how we take your privacy seriously.', href: '#' },
]
</script>
