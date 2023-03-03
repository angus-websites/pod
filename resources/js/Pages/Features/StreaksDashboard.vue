
<template>
    <AppLayout title="Dashboard">
        <PageContainer>
            <div class="px-4 sm:px-6 lg:px-8">
             <p class="text-sm font-medium text-gray-600">Welcome to the streaks dashboard,</p>
             <p class="text-xl font-bold text-gray-900 sm:text-2xl">{{ user.name }}</p>
             <hr class="my-5">
             <div class="flex justify-center">
                <PrimaryButton :isLink="true" :href="route('entries.index')">My Entries</PrimaryButton>
             </div>

            </div>
        </PageContainer>
    </AppLayout>
</template>

<script setup>
import AppNavbar from "@/Components/_includes/AppNavbar.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageContainer from "@/Components/_util/PageContainer.vue";
import EntryTable from "@/Components/dashboard/EntryTable.vue";
import Heading1 from "@/Components/headings/Heading1.vue";
import PrimaryButton from "@/Components/buttons/PrimaryButton.vue";

import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'

const user = computed(() => usePage().props.value.auth.user)

const props = defineProps({
    entries: Object
})

</script>