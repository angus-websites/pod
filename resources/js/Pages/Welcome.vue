<template>
    <GuestLayout title="Home">
        <main class="mx-auto mt-16 max-w-7xl px-4 sm:mt-24">
            <div class="text-center">
                <h1 class="text-4xl font-bold tracking-tight text-grey-900 sm:text-5xl md:text-6xl">
                    <span class="block xl:inline">Keep track of</span>
                    {{ ' ' }}
                    <span class="block text-[#4760C1] xl:inline">your placement year</span>
                </h1>
                <p class="mx-auto mt-3 max-w-md text-sm text-gray-500 sm:text-md md:mt-5 md:max-w-3xl md:text-xl">Make sure you don't forget anything you did on your placement year, record skills, training or anything you want</p>
                <div class="mx-auto mt-5 max-w-md sm:flex sm:justify-center md:mt-8">
                    <PrimaryButton size="l" href="#" :isLink=true class="w-full">
                        Get Started
                    </PrimaryButton>
                    <NeutralButton size="l" href="#" :isLink=true class="w-full mt-4 sm:mt-0 sm:ml-4">
                        Live Demo
                    </NeutralButton>
                </div>
            </div>
        </main>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import PrimaryButton from "@/Components/buttons/PrimaryButton.vue";
import NeutralButton from "@/Components/buttons/NeutralButton.vue";

</script>
