<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import LogoOnly from "@/Components/_includes/LogoOnly.vue";
</script>

<template>
    <Link :href="'/'">
        <LogoOnly class="w-1/3 mx-auto" />
    </Link>
</template>
