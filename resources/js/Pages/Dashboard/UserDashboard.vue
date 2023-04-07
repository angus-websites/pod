<template>
    <DashboardLayout>
        <Stats :features="features" :featureData="featureData" />
    </DashboardLayout>
</template>

<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import Stats from "@/Components/dashboard/Stats.vue";

const props = defineProps({
    features: Object,
    featureData: Object,
})


</script>
