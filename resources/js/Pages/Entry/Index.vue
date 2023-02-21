
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

export default {
    components: {
        PageContainer,
        EntryTable,
        AppLayout,
        Heading1,
        PrimaryButton,
    },
    props: ["entries"],
    mounted() {
        console.log(this.entries["data"])
    }
}
</script>


