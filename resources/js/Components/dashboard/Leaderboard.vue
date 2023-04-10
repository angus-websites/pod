<template>
    <div class="">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Leaderboard</h1>
                <p class="mt-2 text-sm text-gray-700">How you compare to other users in the application</p>
            </div>
        </div>

        <!-- Tabs -->
        <div class="mt-8">
            <div class="sm:hidden">
                <label for="tabs" class="sr-only">Select a tab</label>
                <select @change="onTabChange($event)" id="tabs" name="tabs" class="block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                    <option v-for="tab in tabs" :key="tab.name" :selected="tab.current">{{ tab.name }}</option>
                </select>
            </div>
            <div class="hidden sm:block">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <button v-for="tab in tabs" :key="tab.name" @click="onTabChange(tab)" :class="[tab.current ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700', 'whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium']" :aria-current="tab.current ? 'page' : undefined">{{ tab.name }}</button>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="mt-5 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300 table-fixed">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name</th>
                                    <th scope="col" class="text-left text-sm font-semibold text-gray-900">
                                        {{ currentTab.name }}
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Rank</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                <tr v-for="person in leaderboard.data" :key="person.id" :class="[isUser(person) ? 'bg-primary text-white font-bold' : 'text-gray-500']">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                        <span :class="[isUser(person) ? 'text-white' : 'text-gray-900 font-medium']">{{ person.name }}</span>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm">{{ person.value }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm">{{ person.rank }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {ref, reactive, computed} from 'vue'
import {usePage} from "@inertiajs/inertia-vue3";

// Logged in user
const currentUser = usePage().props.value.auth.user

const props = defineProps({
    features: Object,
    featureData: Object,
})

let leaderboard = reactive(
    {
        "title": "Number of entries",
        "data": props.featureData["entry count"]["leaderboard"]["data"]
    }
);

let tabs = [
    {
        name: 'Number of entries',
        id: 'entry count',
        href: '#',
        current: true },
]

tabs = reactive([
    ...tabs,
    ...(hasFeature("streaks") ? [{
            id: 'streak',
            name: 'Streaks',
            href: "#",
            current: false,
        }]
        : []),
    ...(hasFeature("total word count") ? [{
        name: 'Word count',
        id: 'total word count',
        href: "#",
        current: false,
    }] : [])
]);

let currentTab = ref(tabs[0]);


function isUser(person){
    /**
     * Check the current person on the leaderboard
     * is the logged in user
     */
    console.log(person.id+" vs "+currentUser["id"])
    return person.id === currentUser.id;
}

function hasFeature(feature){
    /**
     * Does the user have access
     * to this feature?
     */
    for (var i = 0; i < props.features.length; i++) {
        if (props.features[i].name == feature){
            return true;
        }
    }
}


function onTabChange(tab){
    /**
     * When a user clicks a tab
     */
    if (tab != currentTab.value){
        setCurrentTab(tab)
    }
}

function setCurrentTab(tab){
    /**
     * Will turn off all other tabs
     * and set this tab as current
     */
    for (const tabKey in tabs) {
        let cTab = tabs[tabKey]

        // Disable
        cTab.current = false

        // Enable if current
        if (cTab.name == tab.name){
            cTab.current = true;

            // Create a new leaderboard object
            const l = {
                "title": tab.name,
                "data": props.featureData[tab.id]["leaderboard"]["data"]
            }

            // Change the leaderboard
            Object.assign(leaderboard, l)
        }
    }
    currentTab.value = tab
}
</script>
