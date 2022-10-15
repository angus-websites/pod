<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PageContainer from "@/Components/Util/PageContainer.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <GuestLayout title="Welcome">
        <PageContainer>
            Hello
        </PageContainer>
    </GuestLayout>
</template>
