
<template>
    <AppLayout title="Dashboard">
        <PageContainer>
            <Heading1>Admin Dashboard</Heading1>
            <UserTable :users="users.data" />

            <p v-for="user in users">{{user.name}}</p>
        </PageContainer>
    </AppLayout>
</template>

<script setup>
import AppNavbar from "@/Components/_includes/AppNavbar.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageContainer from "@/Components/_util/PageContainer.vue";
import Heading1 from "@/Components/headings/Heading1.vue";
import UserTable from "@/Components/dashboard/UserTable.vue";

const props = defineProps({
    users: Object
})

</script>