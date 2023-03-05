<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import PrimaryButton from '@/Components/buttons/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import LogoOnly from "@/Components/_includes/LogoOnly.vue";

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.update'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Reset Password" />

    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <div>
                <Link href="/"><LogoOnly class="h-16 mx-auto" /></Link>
                <h1 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Reset Password</h1>
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
                      <input v-model="form.email" disabled id="email" name="email" type="email" autocomplete="email" required="" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200 sm:text-sm sm:leading-6"/>
                    </div>
                </div>

                <!-- New Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">New password</label>
                    <div class="mt-1">
                      <input v-model="form.password" id="password" name="password" type="password" autocomplete="new-password" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" />
                    </div>
                </div>

                <!-- Confirm -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm password</label>
                    <div class="mt-1">
                      <input v-model="form.password_confirmation" id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" />
                    </div>
                </div>

                <div>
                    <PrimaryButton class="w-full" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Update password
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </div>

</template>
