<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import PrimaryButton from "@/Components/buttons/PrimaryButton.vue";
import LogoOnly from "@/Components/_includes/LogoOnly.vue";
import { XCircleIcon } from '@heroicons/vue/20/solid'

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />

    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <div>
                <Link href="/"><LogoOnly class="h-16 mx-auto" /></Link>
                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Create a new account</h2>
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

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Username</label>
                    <div class="mt-1">
                      <input v-model="form.name" autofocus id="name" name="name" type="text" autocomplete="name" required="" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" />
                    </div>
                    <small class="text-gray-600 text-xs">Will be publicly visible - <a :href="route('policy.show')+'#usernames'">Learn more</a></small>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                    <div class="mt-1">
                      <input v-model="form.email" id="email" name="email" type="email" autocomplete="email" required="" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" />
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="mt-1">
                      <input v-model="form.password" id="password" name="password" type="password" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" />
                    </div>
                </div>

                <!-- Confirm password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm password</label>
                    <div class="mt-1">
                      <input v-model="form.password_confirmation" id="password_confirmation" name="password_confirmation" type="password" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" />
                    </div>
                </div>

                <!-- Terms and privacy policy -->
                <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                    <div class="relative flex items-start">
                        <div class="flex h-6 items-center">
                            <input id="comments" aria-describedby="comments-description" name="comments" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                        </div>
                        <div class="ml-3 text-sm leading-6">
                            <label for="comments" class="font-medium text-gray-900">
                                I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                            </label>
                        </div>
                    </div>
                </div>

                <div>
                    <PrimaryButton class="w-full">
                        Register
                    </PrimaryButton>
                </div>

                <div class="text-sm mt-10">
                    <Link :href="route('login')" class="font-medium text-secondary hover:text-secondary-600">Already have an account?</Link>
                </div>
            </form>
        </div>
    </div>
</template>
