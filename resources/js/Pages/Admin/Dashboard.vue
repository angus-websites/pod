
<template>
    <DashboardLayout>
        <Heading1>Admin Dashboard</Heading1>
        <FeaturesExplained :features="features.data" class="my-10"/>
        <FeatureMatrix :featureGroups="featureGroups.data" :features="features.data" class="my-10"  />
        <UserTable :users="users.data" class="my-10" />
    </DashboardLayout>
</template>

<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import Heading1 from "@/Components/headings/Heading1.vue";
import UserTable from "@/Components/dashboard/UserTable.vue";
import FeatureMatrix from "@/Components/dashboard/FeatureMatrix.vue";
import FeaturesExplained from "@/Components/dashboard/FeaturesExplained.vue";

const props = defineProps({
    users: Object,
    featureGroups: Object,
    features: Object,
})

</script>