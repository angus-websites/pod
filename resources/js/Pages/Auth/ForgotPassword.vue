<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import PrimaryButton from "@/Components/buttons/PrimaryButton.vue";
import LogoOnly from "@/Components/_includes/LogoOnly.vue";
import { CheckCircleIcon, XMarkIcon, XCircleIcon } from '@heroicons/vue/20/solid'
defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <!-- <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div class="mb-4 text-sm text-gray-600">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autofocus
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Email Password Reset Link
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard> -->

    <Head title="Forgot password" />

    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <div>
                <Link href="/"><LogoOnly class="h-16 mx-auto" /></Link>
                <h1 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Forgot password?</h1>
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

                <p> Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>

                <div  v-if="status" class="rounded-md bg-green-50 p-4">
                    <div class="flex">
                      <div class="flex-shrink-0">
                        <CheckCircleIcon class="h-5 w-5 text-green-400" aria-hidden="true" />
                      </div>
                      <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ status }}</p>
                      </div>
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                    <div class="mt-1">
                      <input v-model="form.email" id="email" name="email" type="email" autocomplete="email" required="" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" />
                    </div>
                </div>

                <div>
                    <PrimaryButton class="w-full">
                        Email password reset
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </div>

</template>
