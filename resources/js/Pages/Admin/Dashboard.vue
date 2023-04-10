
<template>
    <DashboardLayout>
        <Heading1>Admin Dashboard</Heading1>
        <FeaturesExplained :features="features.data" class="my-10"/>
        <FeatureMatrix :featureGroups="featureGroups.data" :features="features.data" class="my-10"  />
        <FeatureGroupsExplained :featureGroups="featureGroups.data" class="my-10" />
        <UserTable :users="users" :userCount="userCount" class="my-10" />
    </DashboardLayout>
</template>

<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import Heading1 from "@/Components/headings/Heading1.vue";
import UserTable from "@/Components/dashboard/UserTable.vue";
import FeatureMatrix from "@/Components/dashboard/FeatureMatrix.vue";
import FeaturesExplained from "@/Components/dashboard/FeaturesExplained.vue";
import FeatureGroupsExplained from "@/Components/dashboard/FeatureGroupsExplained.vue";

const props = defineProps({
    users: Object,
    userCount: Number,
    featureGroups: Object,
    features: Object,
})

</script>
