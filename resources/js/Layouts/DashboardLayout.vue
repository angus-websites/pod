<template>
    <AppLayout title="Dashboard">
        <PageContainer>
            <div class="px-4 sm:px-6 lg:px-8">

            <div class="sm:flex sm:items-end">
                <div class="sm:flex-auto">
                    <p class="text-sm font-medium text-gray-600">Welcome back,</p>
                    <p class="text-xl font-bold text-gray-900 sm:text-2xl">{{ user.name }}</p>
                </div>
                <PrimaryButton isLink="true" :href="route('entries.create')" class="my-5 sm:my-0">
                    <span>New Entry</span>
                </PrimaryButton>
            </div>
             <hr class="my-5">
             <slot />
            </div>
        </PageContainer>
    </AppLayout>
</template>

<script setup>
import AppNavbar from "@/Components/_includes/AppNavbar.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageContainer from "@/Components/_util/PageContainer.vue";
import PrimaryButton from "@/Components/buttons/PrimaryButton.vue";

import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'

const user = computed(() => usePage().props.value.auth.user)
</script>
