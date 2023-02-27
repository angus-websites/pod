<template>
  <main class="grid min-h-full place-items-center bg-white py-24 px-6 sm:py-32 lg:px-8">
    <div class="text-center">
      <p class="text-base font-semibold text-secondary">{{status}}</p>
      <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">{{ title }}</h1>
      <p class="mt-6 text-base leading-7 text-gray-600">{{ description }}</p>
      <div class="mt-10 flex items-center justify-center gap-x-6">
        <PrimaryButton :isLink="true" href="/">Home</PrimaryButton>
      </div>
    </div>
  </main>
</template>

<script setup>
import { computed } from 'vue'
import PrimaryButton from "@/Components/buttons/PrimaryButton.vue";

const props = defineProps({ status: Number })

const title = computed(() => {
  return {
    503: 'Service Unavailable',
    500: 'Server Error',
    404: 'Page Not Found',
    403: 'Forbidden',
  }[props.status]
})

const description = computed(() => {
  return {
    503: 'Sorry, we are doing some maintenance. Please check back soon.',
    500: 'Whoops, something went wrong on our servers.',
    404: 'Sorry, the page you are looking for could not be found.',
    403: 'Sorry, you are forbidden from accessing this page.',
  }[props.status]
})
</script>