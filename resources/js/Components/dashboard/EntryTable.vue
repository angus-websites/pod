<template>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <Heading1>Entries</Heading1>
                <p class="mt-2 text-sm text-gray-700">A list of your entries</p>
            </div>
            <PrimaryButton isLink="true" :href="route('entries.create')">
                <span>New Entry</span>
            </PrimaryButton>
        </div>
        <div v-if="entries.data.length > 0" class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr class="divide-x divide-gray-200">
                                <th scope="col" class="py-3.5 pl-4 pr-4 text-left text-sm font-semibold text-gray-900 sm:pl-6">Title</th>
                                <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">Type</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            <template v-if="entries.data">
                                <tr v-for="entry in entries.data" :key="entry.id" class="divide-x divide-gray-200">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm font-medium text-gray-900 sm:pl-6">
                                        <Link class="underline" :href="route('entries.show', entry.id)">{{ entry.title }}</Link>
                                    </td>
                                    <td class="whitespace-nowrap p-4 text-sm text-gray-500">{{ entry.template.name }}</td>
                                </tr>
                            </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Empty-->
        <div v-else class="mt-10">
            <NoEntries />
        </div>
    </div>
    <nav v-if="entries.data.length > 0" class="flex items-center justify-between bg-white px-4 py-3 sm:px-6" aria-label="Pagination">
        <div class="hidden sm:block">
          <p class="text-sm text-gray-700">
            Page
            {{ ' ' }}
            <span class="font-medium">{{entries.meta.from}}</span>
            {{ ' ' }}
            of
            {{ ' ' }}
            <span class="font-medium">{{entries.meta.last_page}}</span>
          </p>
        </div>
        <div class="flex flex-1 justify-between sm:justify-end">
          <Link v-if="entries.links.prev" :href="entries.links.prev" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</Link>
          <Link v-if="entries.links.next"  :href="entries.links.next" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</Link>
        </div>
      </nav>

</template>

<script setup>
import PrimaryButton from "@/Components/buttons/PrimaryButton.vue";
import NoEntries from "@/Components/_util/NoEntries.vue";
import Heading1 from "@/Components/headings/Heading1.vue";

defineProps({
    entries: Object,

});


</script>
