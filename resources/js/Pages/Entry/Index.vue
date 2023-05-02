
<template>
    <AppLayout title="Entries">
        <PageContainer>
            <div class="px-4 sm:px-6 lg:px-8">
                <!-- Heading -->
                <div class="sm:flex sm:items-end">
                    <div class="sm:flex-auto">
                        <Heading1>Your Entries</Heading1>
                        <p class="mt-1 sm:mt-2 text-sm text-gray-700">A list of your entries, you can search and filter by template type. You have <b>{{numberOfEntries}}</b> entries.</p>
                    </div>
                    <PrimaryButton isLink="true" :href="route('entries.create')" class="my-5 sm:my-0">
                        <span>New Entry</span>
                    </PrimaryButton>
                </div>

                <!-- Search & Filter bar -->
                <div class="flex flex-col md:flex-row my-5 md:items-end md:space-x-5 space-y-5">
                    <!-- Filter bar -->
                    <div>
                        <label for="templateType" class="block text-sm font-medium text-gray-700">Template</label>
                        <div class="mt-1">
                          <select v-model="form.template" id="templateType" name="templateType" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option :value="null" label="All">All</option>
                            <option v-for="template in templates" :value="template.id" :key="template.id" :label="template.name">{{template.name}}</option>
                          </select>
                        </div>
                    </div>
                    <!-- Sort bar -->
                    <div>
                        <label for="sortBy" class="block text-sm font-medium text-gray-700">Sort by</label>
                        <div class="mt-1">
                          <select v-model="form.sortBy" id="sortBy" name="sortBy" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option :value="null">Created at</option>
                            <option value="oldest">Oldest</option>
                            <option value="title">Title</option>
                          </select>
                        </div>
                    </div>
                    <!-- Search section -->
                    <div class="flex-1 flex flex-col md:flex-row md:space-x-3 md:space-y-0 space-y-3 items-center">

                        <div class="w-full">
                            <div class="mt-2 flex rounded-md shadow-sm">
                                <div class="relative flex flex-grow items-stretch text-gray-400 focus-within:text-gray-500">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <MagnifyingGlassIcon class="h-5 w-5" aria-hidden="true" />
                                    </div>
                                    <input v-model="form.search" id="search" class="block w-full rounded-l-md border border-gray-300 bg-white py-2 pl-10 pr-3 leading-5 text-gray-900 placeholder-gray-500 focus:border-indigo-500 focus:placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm" placeholder="Search" type="search" name="search" />
                                </div>
                                <button @click="reset" type="button" class="relative -ml-px inline-flex items-center gap-x-1.5 rounded-r-md px-3 py-2 text-sm font-semibold text-gray-600 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                    Reset
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Stat bar -->
                <div class="my-8 flex flex-row justify-center gap-x-10">
                    <div v-if="showing === entries.meta.total">
                        <p class="mt-1 text-sm text-gray-700">Showing {{ showing }} results</p>
                    </div>
                    <div v-else>
                        <p class="mt-1 text-sm text-gray-700">Showing {{ showing }} / {{ entries.meta.total }} results</p>
                    </div>
                </div>
                <!-- Entry table-->
                <EntryTable :entries="entries" :templates="templates"/>

                <!-- Pagination -->
                <nav v-if="entries.data.length > 0" class="flex items-center justify-between bg-white py-3" aria-label="Pagination">
                    <div class="hidden sm:block">
                      <p class="text-sm text-gray-700">
                        Page
                        {{ ' ' }}
                        <span class="font-medium">{{entries.meta.current_page}}</span>
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

            </div>


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
import pickBy from 'lodash/pickBy'

export default {
    components: {
        PageContainer,
        EntryTable,
        AppLayout,
        Heading1,
        PrimaryButton,
        MagnifyingGlassIcon,
    },
    props: ["entries", "templates", "filters", "numberOfEntries", "showing"],
    data() {
      return {
        form: {
          search: this.filters.search,
          template: this.filters.template ?? null,
          sortBy: this.filters.sortBy ?? null,
        },
      };
    },
    watch: {
        form: {
            deep: true,
            handler: throttle(function (value) {
              this.$inertia.get('/entries',
                pickBy(this.form),
                {preserveState: true, replace: true })
            }, 150),
        }
    },
    methods: {
      reset: function (event) {
        /**
         * Reset the filter & search
         */
        this.form.template = null;
        this.form.search = "";
        this.form.sortBy = null;

      }
    }

}
</script>


