<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import Banner from '@/Components/Banner.vue';
import GuestNavbar from "@/Components/_includes/GuestNavbar.vue";
import GuestFooter from "@/Components/_includes/GuestFooter.vue";

defineProps({
    title: String,
});

</script>

<template>
    <Head :title="title" />

    <Banner />

    <div class="body">
        <!-- Navigation -->
        <GuestNavbar />

        <!-- Page Content -->
        <main class="content">
            <slot />
        </main>

        <!-- Footer -->
        <GuestFooter />
    </div>
</template>
