<template>
    <footer class="bg-white">
        <div class="mx-auto max-w-7xl overflow-hidden py-12 px-4 sm:px-6 lg:px-8">
            <p class="mt-8 text-center text-base text-gray-400">&copy; {{ currentYear }} POD. All rights reserved.</p>
        </div>
    </footer>
</template>

<script setup>
import { defineComponent, h } from 'vue'

const currentYear = new Date().getFullYear()

</script>
