
<template>
    <AppLayout title="Dashboard">
        <PageContainer>
            <Heading1>Admin Dashboard</Heading1>
            <UserTable :users="users.data" class="my-10" />
            <FeatureMatrix :featureGroups="featureGroups.data" :features="features.data" class="my-10"  />
        </PageContainer>
    </AppLayout>
</template>

<script setup>
import AppNavbar from "@/Components/_includes/AppNavbar.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageContainer from "@/Components/_util/PageContainer.vue";
import Heading1 from "@/Components/headings/Heading1.vue";
import UserTable from "@/Components/dashboard/UserTable.vue";
import FeatureMatrix from "@/Components/dashboard/FeatureMatrix.vue";

const props = defineProps({
    users: Object,
    featureGroups: Object,
    features: Object,
})

</script>