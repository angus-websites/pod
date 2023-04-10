<template>
    <AppLayout title="Dashboard">
        <PageContainer>
            <div class="px-4 sm:px-6 lg:px-8">
             <p class="text-sm font-medium text-gray-600">Welcome back,</p>
             <p class="text-xl font-bold text-gray-900 sm:text-2xl">{{ user.name }}</p>
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

import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'

const user = computed(() => usePage().props.value.auth.user)
</script>