<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import Banner from '@/Components/Banner.vue';
import AppNavbar from "@/Components/_includes/AppNavbar.vue";
import AppFooter from "@/Components/_includes/AppFooter.vue";
import FlashMessages from '@/Components/FlashMessages.vue'

defineProps({
    title: String,
});

</script>

<template>
    <Head :title="title" />

    <Banner />

    <div class="body">
        <!-- Navigation -->
        <AppNavbar />

        <!-- Flash -->
        <flash-messages />


        <!-- Page Content -->
        <main class="content">
            <slot />
        </main>

        <!-- Footer -->
        <AppFooter />
    </div>
</template>
