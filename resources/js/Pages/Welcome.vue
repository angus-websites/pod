<template>
    <GuestLayout title="Home">
        <main class="mx-auto mt-16 max-w-7xl px-4 sm:mt-24">
            <div class="text-center">
                <h1 class="text-4xl font-bold tracking-tight text-grey-900 sm:text-5xl md:text-6xl">
                    <span class="block xl:inline">Keep track of</span>
                    {{ ' ' }}
                    <span class="block text-[#4760C1] xl:inline">your placement year</span>
                </h1>
                <p class="mx-auto mt-3 max-w-md text-base text-gray-500 sm:text-lg md:mt-5 md:max-w-3xl md:text-xl">Make sure you don't forget anything you did on your placement year, record skills, training or anything you want</p>
                <div class="mx-auto mt-5 max-w-md sm:flex sm:justify-center md:mt-8">
                    <div class="rounded-md shadow">
                        <a href="#" class="flex w-full items-center justify-center rounded-md border border-transparent bg-lime-600 px-8 py-3 text-base font-medium text-white hover:bg-lime-700 md:py-4 md:px-10 md:text-lg">Get started</a>
                    </div>
                    <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3">
                        <a href="#" class="flex w-full items-center justify-center rounded-md border border-transparent bg-white px-8 py-3 text-base font-medium text-[#4760C1] hover:bg-gray-50 md:py-4 md:px-10 md:text-lg">Live demo</a>
                    </div>
                </div>
            </div>
        </main>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";

</script>
