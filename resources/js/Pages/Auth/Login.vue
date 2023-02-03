<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import PrimaryButton from "@/Components/buttons/PrimaryButton.vue";
import LogoOnly from "@/Components/_includes/LogoOnly.vue";
import { XCircleIcon } from '@heroicons/vue/20/solid'

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>

    <Head title="Log in" />

    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <div>
                <Link href="/"><LogoOnly class="h-16 mx-auto" /></Link>
                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Sign in to your account</h2>
            </div>
            <form class="mt-8 space-y-6" @submit.prevent="submit">

                <div v-for="error in form.errors" class="rounded-md bg-red-50 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <XCircleIcon class="h-5 w-5 text-red-400" aria-hidden="true" />
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800">{{error}}</p>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="remember" value="true" />
                <div class="-space-y-px rounded-md shadow-sm">
                    <div>
                        <label for="email-address" class="sr-only">Email address</label>
                        <input v-model="form.email" id="email" name="email" type="email" autocomplete="email" required="" class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-secondary-600 focus:outline-none focus:ring-secondary-600 sm:text-sm" placeholder="Email address" />
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input v-model="form.password" id="password" name="password" type="password" autocomplete="current-password" required="" class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-secondary-600 focus:outline-none focus:ring-secondary-600 sm:text-sm" placeholder="Password" />
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input v-model="form.remember" name="remember" id="remember-me" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-secondary focus:ring-secondary" />
                        <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember me</label>
                    </div>

                    <div class="text-sm" v-if="canResetPassword">
                        <Link :href="route('password.request')" class="font-medium text-secondary hover:text-secondary-600">Forgot your password?</Link>
                    </div>

                </div>

                <div>
                    <PrimaryButton class="w-full">
                        Log in
                    </PrimaryButton>
                </div>

                <div class="text-sm mt-10">
                    <Link :href="route('register')" class="font-medium text-secondary hover:text-secondary-600">Create for an account instead?</Link>
                </div>
            </form>
        </div>
    </div>

</template>
