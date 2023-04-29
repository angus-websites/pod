
<template>
    <Disclosure as="header" class="bg-white shadow" v-slot="{ open }">
        <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:divide-y lg:divide-gray-200 lg:px-8">
            <div class="relative flex h-16 justify-between">
                <div class="relative z-10 flex px-2 lg:px-0">
                    <div class="flex flex-shrink-0 items-center">
                        <TextLogo class="h-8" />
                    </div>
                </div>
                <div class="relative z-10 flex items-center lg:hidden">
                    <!-- Mobile menu button -->
                    <DisclosureButton class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                        <span class="sr-only">Open menu</span>
                        <Bars3Icon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
                        <XMarkIcon v-else class="block h-6 w-6" aria-hidden="true" />
                    </DisclosureButton>
                </div>
                <div class="hidden lg:relative lg:z-10 lg:ml-4 lg:flex lg:items-center">

                    <!-- Profile dropdown -->
                    <Menu as="div" class="relative inline-block text-left">
                        <div>
                            <MenuButton class="inline-flex w-full justify-center px-4 py-2 text-sm font-medium text-gray-700 ">
                                Account
                                <ChevronDownIcon class="-mr-1 ml-2 h-5 w-5" aria-hidden="true" />
                            </MenuButton>
                        </div>

                        <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                            <MenuItems class="absolute right-0 z-10 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <div class="px-4 py-3">
                                    <p class="text-sm">Signed in as</p>
                                    <p class="truncate text-sm font-medium text-gray-900">{{ user.email }}</p>
                                </div>
                                <div class="py-1">
                                    <MenuItem v-for="item in userNavigation" :key="item.name" v-slot="{ active }">
                                        <Link :href="item.href" :class="[active ? 'bg-gray-100' : '', 'block py-2 px-4 text-sm text-gray-700']">{{ item.name }}</Link>
                                    </MenuItem>
                                </div>
                                <div class="py-1">
                                    <form @submit.prevent="logout">
                                        <MenuItem v-slot="{ active }">
                                            <button type="submit" :class="[active ? 'bg-gray-100 text-red-700' : 'text-red-600', 'block w-full px-4 py-2 text-left text-sm']">Sign out</button>
                                        </MenuItem>
                                    </form>
                                </div>
                            </MenuItems>
                        </transition>
                    </Menu>

                </div>
            </div>

            <!-- Navbar -->
            <div class="w-full py-3 lg:border-t lg:border-white lg:border-opacity-20">
              <div class="lg:grid lg:grid-cols-3 lg:items-center lg:gap-8">

                <!-- Left nav -->
                <div class="hidden lg:col-span-2 lg:block">
                  <nav class="flex space-x-4">
                    <Link v-for="item in navigation" :key="item.name" :href="item.href" :class="[item.current ? 'bg-gray-100 text-gray-900' : 'text-gray-900 hover:bg-gray-50 hover:text-gray-900', 'rounded-md py-2 px-3 inline-flex items-center text-sm font-medium']" :aria-current="item.current ? 'page' : undefined">{{ item.name }}</Link>
                  </nav>
                </div>
              </div>
            </div>
        </div>

        <DisclosurePanel as="nav" class="lg:hidden" aria-label="Global">
            <div class="space-y-1 px-2 pt-2 pb-3">
                <DisclosureButton v-for="item in navigation" :key="item.name" as="a" :href="item.href" :class="[item.current ? 'bg-gray-100 text-gray-900' : 'text-gray-900 hover:bg-gray-50 hover:text-gray-900', 'block rounded-md py-2 px-3 text-base font-medium']" :aria-current="item.current ? 'page' : undefined">{{ item.name }}</DisclosureButton>
            </div>
            <div class="border-t border-gray-200 pt-4 pb-3">
                <div class="flex items-center px-4">
                    <div class="ml-2">
                        <div class="text-base font-medium text-gray-800">{{ user.name }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ user.email }}</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1 px-2">
                    <DisclosureButton v-for="item in userNavigation" :key="item.name" as="a" :href="item.href" class="block rounded-md py-2 px-3 text-base font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-900">{{ item.name }}</DisclosureButton>
                </div>
            </div>
            <form @submit.prevent="logout">
                <div class="my-3 px-5">
                    <DangerButton size="s" class="mx-auto">Sign out</DangerButton>
                </div>
            </form>
        </DisclosurePanel>
    </Disclosure>
    <div v-if="$page.props.isSuperAdmin" class="flex justify-center bg-blue-600 py-2.5 px-6 sm:px-3.5">
        <div>
            <p class="text-sm text-white font-medium">
          <b>Super Admin</b>
            </p>
        </div>
    </div>
    <div v-else-if="$page.props.isAdmin" class="flex justify-center bg-red-600 py-2.5 px-6 sm:px-3.5">
        <div>
            <p class="text-sm text-white font-medium">
          <b>Admin</b>
            </p>
        </div>
    </div>
</template>

<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { MagnifyingGlassIcon } from '@heroicons/vue/20/solid'
import { Bars3Icon, XMarkIcon } from '@heroicons/vue/24/outline'
import TextLogo from "@/Components/_includes/TextLogo.vue";
import {Inertia} from "@inertiajs/inertia";
import { ChevronDownIcon } from '@heroicons/vue/20/solid'
import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'
import DangerButton from "@/components/buttons/DangerButton.vue";

// Fetch user
const user = computed(() => usePage().props.value.auth.user)
const canGenerateCV = usePage().props.value.canGenerateCV
const canGiveFeedback = usePage().props.value.canGiveFeedback

let navigation = [
    { name: 'Dashboard', href: route('dashboard'), current: route().current('dashboard') },
    { name: 'Entries', href: '/entries', current: route().current('entries.*') },
]

navigation = [
    ...navigation,
    ...(canGenerateCV ? [{
            name: 'Generate CV',
            href: route('cv'),
            current: route().current('cv')
        }]
        : []),
    ...(canGiveFeedback ? [{
            name: 'Feedback',
            href: route('feedback'),
            current: route().current('feedback')
        }]
        : []),

]

const userNavigation = [
    { name: 'Your Profile', href: route('profile.show') },
]

const logout = () => {
    Inertia.post(route('logout'));
};

</script>
