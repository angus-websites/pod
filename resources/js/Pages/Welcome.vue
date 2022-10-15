<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PageContainer from "@/Components/Util/PageContainer.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'

</script>

<template>
    <GuestLayout title="Welcome">
        <PageContainer>
            <Menu>
                <MenuButton>More</MenuButton>
                <MenuItems>
                    <MenuItem v-slot="{ active }">
                        <a :class='{ "bg-blue-500": active }' href="/account-settings">
                            Account settings
                        </a>
                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                        <a :class='{ "bg-blue-500": active }' href="/account-settings">
                            Documentation
                        </a>
                    </MenuItem>
                    <MenuItem disabled>
                        <span class="opacity-75">Invite a friend (coming soon!)</span>
                    </MenuItem>
                </MenuItems>
            </Menu>
        </PageContainer>
    </GuestLayout>
</template>
