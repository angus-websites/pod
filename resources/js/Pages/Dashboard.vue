<!--
  This example requires some changes to your config:

  ```
  // tailwind.config.js
  const colors = require('tailwindcss/colors')

  module.exports = {
    // ...
    theme: {
      extend: {
        colors: {
          indigo: colors.indigo,
        },
      },
    },
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->
<template>
    <!--
      This example requires updating your template:

      ```
      <html class="h-full bg-gray-100">
      <body class="h-full">
      ```
    -->
    <div class="min-h-full">
        <!-- When the mobile menu is open, add `overflow-hidden` to the `body` element to prevent double scrollbars -->
        <Popover as="template" v-slot="{ open }">
            <header :class="[open ? 'fixed inset-0 z-40 overflow-y-auto' : '', 'bg-white shadow-sm lg:static lg:overflow-y-visible']">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="relative flex justify-between lg:gap-8 xl:grid xl:grid-cols-12">
                        <div class="flex md:absolute md:inset-y-0 md:left-0 lg:static xl:col-span-2">
                            <div class="flex flex-shrink-0 items-center">
                                <a href="#">
                                    <TextLogo class="h-8" />
                                </a>
                            </div>
                        </div>
                        <div class="min-w-0 flex-1 md:px-8 lg:px-0 xl:col-span-6">
                            <div class="flex items-center px-6 py-4 md:mx-auto md:max-w-3xl lg:mx-0 lg:max-w-none xl:px-0">
                                <div class="w-full">
                                    <label for="search" class="sr-only">Search</label>
                                    <div class="relative">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                            <MagnifyingGlassIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                                        </div>
                                        <input id="search" name="search" class="block w-full rounded-md border border-gray-300 bg-white py-2 pl-10 pr-3 text-sm placeholder-gray-500 focus:border-indigo-500 focus:text-gray-900 focus:placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm" placeholder="Search" type="search" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center md:absolute md:inset-y-0 md:right-0 lg:hidden">
                            <!-- Mobile menu button -->
                            <PopoverButton class="-mx-2 inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                                <span class="sr-only">Open menu</span>
                                <Bars3Icon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
                                <XMarkIcon v-else class="block h-6 w-6" aria-hidden="true" />
                            </PopoverButton>
                        </div>
                        <div class="hidden lg:flex lg:items-center lg:justify-end xl:col-span-4">
                            <a href="#" class="text-sm font-medium text-gray-900 hover:underline">Go Premium</a>
                            <a href="#" class="ml-5 flex-shrink-0 rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <span class="sr-only">View notifications</span>
                                <BellIcon class="h-6 w-6" aria-hidden="true" />
                            </a>

                            <!-- Profile dropdown -->
                            <Menu as="div" class="relative ml-5 flex-shrink-0">
                                <div>
                                    <MenuButton class="flex rounded-full bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                        <span class="sr-only">Open user menu</span>
                                        <img class="h-8 w-8 rounded-full" :src="user.imageUrl" alt="" />
                                    </MenuButton>
                                </div>
                                <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                                    <MenuItems class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                        <MenuItem v-for="item in userNavigation" :key="item.name" v-slot="{ active }">
                                            <a :href="item.href" :class="[active ? 'bg-gray-100' : '', 'block py-2 px-4 text-sm text-gray-700']">{{ item.name }}</a>
                                        </MenuItem>
                                    </MenuItems>
                                </transition>
                            </Menu>

                            <a href="#" class="ml-6 inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">New Post</a>
                        </div>
                    </div>
                </div>

                <PopoverPanel as="nav" class="lg:hidden" aria-label="Global">
                    <div class="mx-auto max-w-3xl space-y-1 px-2 pt-2 pb-3 sm:px-4">
                        <a v-for="item in navigation" :key="item.name" :href="item.href" :aria-current="item.current ? 'page' : undefined" :class="[item.current ? 'bg-gray-100 text-gray-900' : 'hover:bg-gray-50', 'block rounded-md py-2 px-3 text-base font-medium']">{{ item.name }}</a>
                    </div>
                    <div class="border-t border-gray-200 pt-4">
                        <div class="mx-auto flex max-w-3xl items-center px-4 sm:px-6">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" :src="user.imageUrl" alt="" />
                            </div>
                            <div class="ml-3">
                                <div class="text-base font-medium text-gray-800">{{ user.name }}</div>
                                <div class="text-sm font-medium text-gray-500">{{ user.email }}</div>
                            </div>
                            <button type="button" class="ml-auto flex-shrink-0 rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <span class="sr-only">View notifications</span>
                                <BellIcon class="h-6 w-6" aria-hidden="true" />
                            </button>
                        </div>
                        <div class="mx-auto mt-3 max-w-3xl space-y-1 px-2 sm:px-4">
                            <a v-for="item in userNavigation" :key="item.name" :href="item.href" class="block rounded-md py-2 px-3 text-base font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-900">{{ item.name }}</a>
                        </div>
                    </div>

                    <div class="mx-auto mt-6 max-w-3xl px-4 sm:px-6">
                        <a href="#" class="flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700">New Post</a>

                        <div class="mt-6 flex justify-center">
                            <a href="#" class="text-base font-medium text-gray-900 hover:underline">Go Premium</a>
                        </div>
                    </div>
                </PopoverPanel>
            </header>
        </Popover>

        <div class="py-10">
            <div class="mx-auto max-w-3xl sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-12 lg:gap-8 lg:px-8">
                <div class="hidden lg:col-span-3 lg:block xl:col-span-2">
                    <nav aria-label="Sidebar" class="sticky top-4 divide-y divide-gray-300">
                        <div class="space-y-1 pb-8">
                            <a v-for="item in navigation" :key="item.name" :href="item.href" :class="[item.current ? 'bg-gray-200 text-gray-900' : 'text-gray-700 hover:bg-gray-50', 'group flex items-center px-3 py-2 text-sm font-medium rounded-md']" :aria-current="item.current ? 'page' : undefined">
                                <component :is="item.icon" :class="[item.current ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500', 'flex-shrink-0 -ml-1 mr-3 h-6 w-6']" aria-hidden="true" />
                                <span class="truncate">{{ item.name }}</span>
                            </a>
                        </div>
                        <div class="pt-10">
                            <p class="px-3 text-sm font-medium text-gray-500" id="communities-headline">Communities</p>
                            <div class="mt-3 space-y-2" aria-labelledby="communities-headline">
                                <a v-for="community in communities" :key="community.name" :href="community.href" class="group flex items-center rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900">
                                    <span class="truncate">{{ community.name }}</span>
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>

                <main class="lg:col-span-9 xl:col-span-5">
                    <div class="px-4 sm:px-0">
                        <div class="sm:hidden">
                            <label for="question-tabs" class="sr-only">Select a tab</label>
                            <select id="question-tabs" class="block w-full rounded-md border-gray-300 text-base font-medium text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option v-for="tab in tabs" :key="tab.name" :selected="tab.current">{{ tab.name }}</option>
                            </select>
                        </div>
                        <div class="hidden sm:block">
                            <nav class="isolate flex divide-x divide-gray-200 rounded-lg shadow" aria-label="Tabs">
                                <a v-for="(tab, tabIdx) in tabs" :key="tab.name" :href="tab.href" :aria-current="tab.current ? 'page' : undefined" :class="[tab.current ? 'text-gray-900' : 'text-gray-500 hover:text-gray-700', tabIdx === 0 ? 'rounded-l-lg' : '', tabIdx === tabs.length - 1 ? 'rounded-r-lg' : '', 'group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-6 text-sm font-medium text-center hover:bg-gray-50 focus:z-10']">
                                    <span>{{ tab.name }}</span>
                                    <span aria-hidden="true" :class="[tab.current ? 'bg-indigo-500' : 'bg-transparent', 'absolute inset-x-0 bottom-0 h-0.5']" />
                                </a>
                            </nav>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h1 class="sr-only">Recent questions</h1>
                        <ul role="list" class="space-y-4">

                            <ul role="list" class="divide-y divide-gray-200 border-b border-gray-200">
                                <li v-for="project in projects" :key="project.repo" class="relative py-5 pl-4 pr-6 hover:bg-gray-50 sm:py-6 sm:pl-6 lg:pl-8 xl:pl-6">
                                    <div class="flex items-center justify-between space-x-4">
                                        <!-- Repo name and link -->
                                        <div class="min-w-0 space-y-3">
                                            <div class="flex items-center space-x-3">
                    <span :class="[project.active ? 'bg-green-100' : 'bg-gray-100', 'h-4 w-4 rounded-full flex items-center justify-center']" aria-hidden="true">
                      <span :class="[project.active ? 'bg-green-400' : 'bg-gray-400', 'h-2 w-2 rounded-full']" />
                    </span>

                                                <h2 class="text-sm font-medium">
                                                    <a :href="project.href">
                                                        <span class="absolute inset-0" aria-hidden="true" />
                                                        {{ project.name }} <span class="sr-only">{{ project.active ? 'Running' : 'Not running' }}</span>
                                                    </a>
                                                </h2>
                                            </div>
                                            <a :href="project.repoHref" class="group relative flex items-center space-x-2.5">
                                                <svg class="h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.99917 0C4.02996 0 0 4.02545 0 8.99143C0 12.9639 2.57853 16.3336 6.15489 17.5225C6.60518 17.6053 6.76927 17.3277 6.76927 17.0892C6.76927 16.8762 6.76153 16.3104 6.75711 15.5603C4.25372 16.1034 3.72553 14.3548 3.72553 14.3548C3.31612 13.316 2.72605 13.0395 2.72605 13.0395C1.9089 12.482 2.78793 12.4931 2.78793 12.4931C3.69127 12.5565 4.16643 13.4198 4.16643 13.4198C4.96921 14.7936 6.27312 14.3968 6.78584 14.1666C6.86761 13.5859 7.10022 13.1896 7.35713 12.965C5.35873 12.7381 3.25756 11.9665 3.25756 8.52116C3.25756 7.53978 3.6084 6.73667 4.18411 6.10854C4.09129 5.88114 3.78244 4.96654 4.27251 3.72904C4.27251 3.72904 5.02778 3.48728 6.74717 4.65082C7.46487 4.45101 8.23506 4.35165 9.00028 4.34779C9.76494 4.35165 10.5346 4.45101 11.2534 4.65082C12.9717 3.48728 13.7258 3.72904 13.7258 3.72904C14.217 4.96654 13.9082 5.88114 13.8159 6.10854C14.3927 6.73667 14.7408 7.53978 14.7408 8.52116C14.7408 11.9753 12.6363 12.7354 10.6318 12.9578C10.9545 13.2355 11.2423 13.7841 11.2423 14.6231C11.2423 15.8247 11.2313 16.7945 11.2313 17.0892C11.2313 17.3299 11.3937 17.6097 11.8501 17.522C15.4237 16.3303 18 12.9628 18 8.99143C18 4.02545 13.97 0 8.99917 0Z" fill="currentcolor" />
                                                </svg>
                                                <span class="truncate text-sm font-medium text-gray-500 group-hover:text-gray-900">{{ project.repo }}</span>
                                            </a>
                                        </div>
                                        <div class="sm:hidden">
                                            <ChevronRightIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                                        </div>
                                        <!-- Repo meta info -->
                                        <div class="hidden flex-shrink-0 flex-col items-end space-y-3 sm:flex">
                                            <p class="flex items-center space-x-4">
                                                <a :href="project.siteHref" class="relative text-sm font-medium text-gray-500 hover:text-gray-900">Visit site</a>
                                                <button type="button" class="relative rounded-full bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                    <span class="sr-only">{{ project.starred ? 'Add to favorites' : 'Remove from favorites' }}</span>
                                                    <StarIcon :class="[project.starred ? 'text-yellow-300 hover:text-yellow-400' : 'text-gray-300 hover:text-gray-400', 'h-5 w-5']" aria-hidden="true" />
                                                </button>
                                            </p>
                                            <p class="flex space-x-2 text-sm text-gray-500">
                                                <span>{{ project.tech }}</span>
                                                <span aria-hidden="true">&middot;</span>
                                                <span>Last deploy {{ project.lastDeploy }}</span>
                                                <span aria-hidden="true">&middot;</span>
                                                <span>{{ project.location }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>

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
                        </ul>
                    </div>
                </main>
                <aside class="hidden xl:col-span-5 xl:block">
                    <div class="md:pr-14">
                        <div class="flex items-center">
                            <h2 class="flex-auto font-semibold text-gray-900">January 2022</h2>
                            <button type="button" class="-my-1.5 flex flex-none items-center justify-center p-1.5 text-gray-400 hover:text-gray-500">
                                <span class="sr-only">Previous month</span>
                                <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
                            </button>
                            <button type="button" class="-my-1.5 -mr-1.5 ml-2 flex flex-none items-center justify-center p-1.5 text-gray-400 hover:text-gray-500">
                                <span class="sr-only">Next month</span>
                                <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
                            </button>
                        </div>
                        <div class="mt-10 grid grid-cols-7 text-center text-xs leading-6 text-gray-500">
                            <div>M</div>
                            <div>T</div>
                            <div>W</div>
                            <div>T</div>
                            <div>F</div>
                            <div>S</div>
                            <div>S</div>
                        </div>
                        <div class="mt-2 grid grid-cols-7 text-sm">
                            <div v-for="(day, dayIdx) in days" :key="day.date" :class="[dayIdx > 6 && 'border-t border-gray-200', 'py-2']">
                                <button type="button" :class="[day.isSelected && 'text-white', !day.isSelected && day.isToday && 'text-indigo-600', !day.isSelected && !day.isToday && day.isCurrentMonth && 'text-gray-900', !day.isSelected && !day.isToday && !day.isCurrentMonth && 'text-gray-400', day.isSelected && day.isToday && 'bg-indigo-600', day.isSelected && !day.isToday && 'bg-gray-900', !day.isSelected && 'hover:bg-gray-200', (day.isSelected || day.isToday) && 'font-semibold', 'mx-auto flex h-8 w-8 items-center justify-center rounded-full']">
                                    <time :datetime="day.date">{{ day.date.split('-').pop().replace(/^0/, '') }}</time>
                                </button>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Menu, MenuButton, MenuItem, MenuItems, Popover, PopoverButton, PopoverPanel } from '@headlessui/vue'
import {
    ChatBubbleLeftEllipsisIcon,
    CodeBracketIcon,
    EllipsisVerticalIcon,
    EyeIcon,
    FlagIcon,
    HandThumbUpIcon,
    MagnifyingGlassIcon,
    PlusIcon,
    ShareIcon,
    StarIcon,
} from '@heroicons/vue/20/solid'
import {
    ArrowTrendingUpIcon,
    Bars3Icon,
    BellIcon,
    FireIcon,
    HomeIcon,
    UserGroupIcon,
    XMarkIcon,
} from '@heroicons/vue/24/outline'
import TextLogo from "@/Components/_includes/TextLogo.vue";


const props = defineProps({
    entries: Object
})

const user = {
    name: 'Chelsea Hagon',
    email: 'chelsea.hagon@example.com',
    imageUrl:
        'https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
}
const navigation = [
    { name: 'Home', href: '#', icon: HomeIcon, current: true },
    { name: 'Timeline', href: '#', icon: FireIcon, current: false },
    { name: 'Communities', href: '#', icon: UserGroupIcon, current: false },
    { name: 'Trending', href: '#', icon: ArrowTrendingUpIcon, current: false },
]
const userNavigation = [
    { name: 'Your Profile', href: '#' },
    { name: 'Settings', href: '#' },
    { name: 'Sign out', href: '#' },
]
const communities = [
    { name: 'Movies', href: '#' },
    { name: 'Food', href: '#' },
    { name: 'Sports', href: '#' },
    { name: 'Animals', href: '#' },
    { name: 'Science', href: '#' },
    { name: 'Dinosaurs', href: '#' },
    { name: 'Talents', href: '#' },
    { name: 'Gaming', href: '#' },
]
const tabs = [
    { name: 'Recent', href: '#', current: true },
    { name: 'Most Liked', href: '#', current: false },
    { name: 'Most Answers', href: '#', current: false },
]

import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/20/solid'

const projects = [


    {
        name: 'Workcation',
        href: '#',
        siteHref: '#',
        repoHref: '#',
        repo: 'debbielewis/workcation',
        tech: 'Laravel',
        lastDeploy: '3h ago',
        location: 'United states',
        starred: true,
        active: true,
    },
    // More projects...
]

const days = [
    { date: '2021-12-27' },
    { date: '2021-12-28' },
    { date: '2021-12-29' },
    { date: '2021-12-30' },
    { date: '2021-12-31' },
    { date: '2022-01-01', isCurrentMonth: true },
    { date: '2022-01-02', isCurrentMonth: true },
    { date: '2022-01-03', isCurrentMonth: true },
    { date: '2022-01-04', isCurrentMonth: true },
    { date: '2022-01-05', isCurrentMonth: true },
    { date: '2022-01-06', isCurrentMonth: true },
    { date: '2022-01-07', isCurrentMonth: true },
    { date: '2022-01-08', isCurrentMonth: true },
    { date: '2022-01-09', isCurrentMonth: true },
    { date: '2022-01-10', isCurrentMonth: true },
    { date: '2022-01-11', isCurrentMonth: true },
    { date: '2022-01-12', isCurrentMonth: true, isToday: true },
    { date: '2022-01-13', isCurrentMonth: true },
    { date: '2022-01-14', isCurrentMonth: true },
    { date: '2022-01-15', isCurrentMonth: true },
    { date: '2022-01-16', isCurrentMonth: true },
    { date: '2022-01-17', isCurrentMonth: true },
    { date: '2022-01-18', isCurrentMonth: true },
    { date: '2022-01-19', isCurrentMonth: true },
    { date: '2022-01-20', isCurrentMonth: true },
    { date: '2022-01-21', isCurrentMonth: true, isSelected: true },
    { date: '2022-01-22', isCurrentMonth: true },
    { date: '2022-01-23', isCurrentMonth: true },
    { date: '2022-01-24', isCurrentMonth: true },
    { date: '2022-01-25', isCurrentMonth: true },
    { date: '2022-01-26', isCurrentMonth: true },
    { date: '2022-01-27', isCurrentMonth: true },
    { date: '2022-01-28', isCurrentMonth: true },
    { date: '2022-01-29', isCurrentMonth: true },
    { date: '2022-01-30', isCurrentMonth: true },
    { date: '2022-01-31', isCurrentMonth: true },
    { date: '2022-02-01' },
    { date: '2022-02-02' },
    { date: '2022-02-03' },
    { date: '2022-02-04' },
    { date: '2022-02-05' },
    { date: '2022-02-06' },
]

</script>
