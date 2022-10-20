<template>
    <!-- Background color split screen for large screens -->
    <div class="fixed top-0 left-0 h-full w-1/2 bg-white" aria-hidden="true" />
    <div class="fixed top-0 right-0 h-full w-1/2 bg-gray-50" aria-hidden="true" />
    <div class="relative flex min-h-screen flex-col">
        <!-- Navbar -->
        <Disclosure as="nav" class="flex-shrink-0 bg-indigo-600" v-slot="{ open }">
            <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:px-8">
                <div class="relative flex h-16 items-center justify-between">
                    <!-- Logo section -->
                    <div class="flex items-center px-2 lg:px-0 xl:w-64">
                        <div class="flex-shrink-0">
                            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=300" alt="Your Company" />
                        </div>
                    </div>

                    <!-- Search section -->
                    <div class="flex flex-1 justify-center lg:justify-end">
                        <div class="w-full px-2 lg:px-6">
                            <label for="search" class="sr-only">Search projects</label>
                            <div class="relative text-indigo-200 focus-within:text-gray-400">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <MagnifyingGlassIcon class="h-5 w-5" aria-hidden="true" />
                                </div>
                                <input id="search" name="search" class="block w-full rounded-md border border-transparent bg-indigo-400 bg-opacity-25 py-2 pl-10 pr-3 leading-5 text-indigo-100 placeholder-indigo-200 focus:bg-white focus:text-gray-900 focus:placeholder-gray-400 focus:outline-none focus:ring-0 sm:text-sm" placeholder="Search projects" type="search" />
                            </div>
                        </div>
                    </div>
                    <div class="flex lg:hidden">
                        <!-- Mobile menu button -->
                        <DisclosureButton class="inline-flex items-center justify-center rounded-md bg-indigo-600 p-2 text-indigo-400 hover:bg-indigo-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-600">
                            <span class="sr-only">Open main menu</span>
                            <Bars3CenterLeftIcon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
                            <XMarkIcon v-else class="block h-6 w-6" aria-hidden="true" />
                        </DisclosureButton>
                    </div>
                    <!-- Links section -->
                    <div class="hidden lg:block lg:w-80">
                        <div class="flex items-center justify-end">
                            <div class="flex">
                                <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-indigo-200 hover:text-white">Documentation</a>
                                <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-indigo-200 hover:text-white">Support</a>
                            </div>
                            <!-- Profile dropdown -->
                            <Menu as="div" class="relative ml-4 flex-shrink-0">
                                <div>
                                    <MenuButton class="flex rounded-full bg-indigo-700 text-sm text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-700">
                                        <span class="sr-only">Open user menu</span>
                                        <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=256&h=256&q=80" alt="" />
                                    </MenuButton>
                                </div>
                                <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                                    <MenuItems class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                        <MenuItem v-slot="{ active }">
                                            <a :href="route('profile.show')" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">View Profile</a>
                                        </MenuItem>
                                        <MenuItem v-slot="{ active }">
                                            <a href="#" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Settings</a>
                                        </MenuItem>
                                        <MenuItem v-slot="{ active }">
                                            <a href="#" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Logout</a>
                                        </MenuItem>
                                    </MenuItems>
                                </transition>
                            </Menu>
                        </div>
                    </div>
                </div>
            </div>

            <DisclosurePanel class="lg:hidden">
                <div class="px-2 pt-2 pb-3">
                    <DisclosureButton as="a" href="#" class="block rounded-md bg-indigo-800 px-3 py-2 text-base font-medium text-white">Dashboard</DisclosureButton>
                    <DisclosureButton as="a" href="#" class="mt-1 block rounded-md px-3 py-2 text-base font-medium text-indigo-200 hover:bg-indigo-600 hover:text-indigo-100">Support</DisclosureButton>
                </div>
                <div class="border-t border-indigo-800 pt-4 pb-3">
                    <div class="px-2">
                        <DisclosureButton as="a" href="#" class="block rounded-md px-3 py-2 text-base font-medium text-indigo-200 hover:bg-indigo-600 hover:text-indigo-100">Your Profile</DisclosureButton>
                        <DisclosureButton as="a" href="#" class="mt-1 block rounded-md px-3 py-2 text-base font-medium text-indigo-200 hover:bg-indigo-600 hover:text-indigo-100">Settings</DisclosureButton>
                        <DisclosureButton as="a" href="#" class="mt-1 block rounded-md px-3 py-2 text-base font-medium text-indigo-200 hover:bg-indigo-600 hover:text-indigo-100">Sign out</DisclosureButton>
                    </div>
                </div>
            </DisclosurePanel>
        </Disclosure>

        <!-- 3 column wrapper -->
        <div class="mx-auto w-full max-w-7xl flex-grow lg:flex xl:px-8">
            <!-- Left sidebar & main wrapper -->
            <div class="min-w-0 flex-1 bg-white xl:flex">
                <div class="border-b border-gray-200 bg-white xl:w-64 xl:flex-shrink-0 xl:border-b-0 xl:border-r xl:border-gray-200">
                    <div class="h-full py-6 pl-4 pr-6 sm:pl-6 lg:pl-8 xl:pl-0">
                        <!-- Start left column area -->
                        <div class="relative h-full" style="min-height: 12rem">
                            <nav class="mt-5 space-y-1 px-2">
                                <a v-for="item in navigation" :key="item.name" :href="item.href" :class="[item.current ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900', 'group flex items-center px-2 py-2 text-base font-medium rounded-md']">
                                    <component :is="item.icon" :class="[item.current ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500', 'mr-4 flex-shrink-0 h-6 w-6']" aria-hidden="true" />
                                    {{ item.name }}
                                </a>
                            </nav>
                        </div>
                        <!-- End left column area -->
                    </div>
                </div>

                <div class="bg-white lg:min-w-0 lg:flex-1">
                    <div class="h-full">
                        <!-- Start main area-->
                        <div class="relative h-full" style="min-height: 36rem">
                            <div class="">
                                <ul v-if="entries" role="list" class="divide-y divide-gray-200">
                                    <li v-for="entry in entries" :key="entry.id" class="relative bg-white py-5 px-4 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 hover:bg-gray-50">
                                        <div class="flex justify-between space-x-3">
                                            <div class="min-w-0 flex-1">
                                                <a href="#" class="block focus:outline-none">
                                                    <span class="absolute inset-0" aria-hidden="true" />
                                                    <p class="truncate text-sm font-medium text-gray-900">{{ entry.title }}</p>
                                                </a>
                                            </div>
<!--                                            <time class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">{{ message.date }}</time>-->
                                            <p class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">{{ entry.date }}</p>
                                        </div>
                                        <div class="mt-1">
                                            <p class="text-sm text-gray-600 line-clamp-2">{{ entry.preview }}</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- End main area -->
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 pr-4 sm:pr-6 lg:flex-shrink-0 lg:border-l lg:border-gray-200 lg:pr-8 xl:pr-0">
                <div class="h-full py-6 pl-6 lg:w-80">
                    <!-- Start right column area -->
                    <div class="relative h-full" style="min-height: 16rem">
                        <div class="absolute inset-0 rounded-lg border-2 border-dashed border-gray-200" />
                    </div>
                    <!-- End right column area -->
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { MagnifyingGlassIcon } from '@heroicons/vue/20/solid'
import { Bars3CenterLeftIcon, XMarkIcon } from '@heroicons/vue/24/outline'


import {onMounted} from "vue";

const props = defineProps({
    entries: Object
})

onMounted(() => {
    console.log(this.entries)
})


const turtle = [
    {
        id: 1,
        title: 'My First Diary entry',
        date: '03/12/23',
        preview:
            'Doloremque dolorem maiores assumenda dolorem facilis. Velit vel in a rerum natus facere. Enim rerum eaque qui facilis. Numquam laudantium sed id dolores omnis in. Eos reiciendis deserunt maiores et accusamus quod dolor.',
    },
    {
        id: 2,
        title: 'Google training',
        date: '02/11/23',
        preview:
            'Doloremque dolorem maiores assumenda dolorem facilis. Velit vel in a rerum natus facere. Enim rerum eaque qui facilis. Numquam laudantium sed id dolores omnis in. Eos reiciendis deserunt maiores et accusamus quod dolor.',
    },
    {
        id: 3,
        title: 'Team presentation',
        date: '03/12/23',
        preview:
            'Doloremque dolorem maiores assumenda dolorem facilis. Velit vel in a rerum natus facere. Enim rerum eaque qui facilis. Numquam laudantium sed id dolores omnis in. Eos reiciendis deserunt maiores et accusamus quod dolor.',
    },
    // More messages...
]

import {
    CalendarIcon,
    ChartBarIcon,
    FolderIcon,
    HomeIcon,
    InboxIcon,
    UsersIcon,
} from '@heroicons/vue/24/outline'

const navigation = [
    { name: 'Home', href: '#', icon: HomeIcon, current: true },
    { name: 'Team', href: '#', icon: UsersIcon, current: false },
    { name: 'Projects', href: '#', icon: FolderIcon, current: false },
    { name: 'Calendar', href: '#', icon: CalendarIcon, current: false },
    { name: 'Documents', href: '#', icon: InboxIcon, current: false },
    { name: 'Reports', href: '#', icon: ChartBarIcon, current: false },
]

</script>
