
<template>
    <AppLayout title="Entries">
        <PageContainer>
            <div class="px-4 sm:px-6 lg:px-8">
                <!-- Heading -->
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <Heading1>Entries</Heading1>
                        <p class="mt-2 text-sm text-gray-700">A list of your entries</p>
                    </div>
                    <PrimaryButton isLink="true" :href="route('entries.create')">
                        <span>New Entry</span>
                    </PrimaryButton>
                </div>
                <!-- Search section -->
                <div class="w-full max-w-lg lg:max-w-xs my-5">
                  <label for="search" class="sr-only">Search</label>
                  <div class="relative text-gray-400 focus-within:text-gray-500">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                      <MagnifyingGlassIcon class="h-5 w-5" aria-hidden="true" />
                    </div>
                    <input v-model="searchQuery" id="search" class="block w-full rounded-md border border-gray-300 bg-white py-2 pl-10 pr-3 leading-5 text-gray-900 placeholder-gray-500 focus:border-purple-500 focus:placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-purple-500 sm:text-sm" placeholder="Search" type="search" name="search" />
                  </div>
                </div>
                <!-- Entry table-->
                <EntryTable :entries="entries" class="my-8 border" />
            </div>

            <!-- Pagination -->
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
        </PageContainer>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import PageContainer from "@/Components/_util/PageContainer.vue";
import EntryTable from "@/Components/dashboard/EntryTable.vue";
import PrimaryButton from "@/Components/buttons/PrimaryButton.vue";
import Heading1 from "@/Components/headings/Heading1.vue";
import {MagnifyingGlassIcon} from '@heroicons/vue/20/solid';
import throttle from 'lodash/throttle'

export default {
    components: {
        PageContainer,
        EntryTable,
        AppLayout,
        Heading1,
        PrimaryButton,
        MagnifyingGlassIcon,
    },
    props: ["entries", "filters"],
    data() {
      return {
        searchQuery: this.filters.search,
      };
    },
    mounted() {
        console.log(this.entries["data"])
    },
    watch: {
        searchQuery: {
            handler: throttle(function (value) {
              this.$inertia.get('/entries',{ search: value}, {preserveState: true, replace: true })
            }, 150),
        }
    },

}
</script>


