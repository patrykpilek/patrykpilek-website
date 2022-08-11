<script setup>
import { Link, useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import JetButton from '@/Components/Button.vue';
import JetInput from '@/Components/Input.vue';
import JetCheckbox from '@/Components/Checkbox.vue';
import JetLabel from '@/Components/Label.vue';
import JetInputError from '@/Components/InputError.vue';

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
    <AppLayout title="Sign In">
        <template #nav></template>

        <div class="min-h-full flex flex-col justify-center py-24 sm:px-6 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-md">

                <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                    {{ status }}
                </div>

                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Sign in to your account</h2>
            </div>

            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                <div class="bg-white py-8 px-4 shadow-2xl shadow-blue-500/50 sm:rounded-lg sm:px-10">
                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <JetLabel for="email" value="Email address" />
                            <JetInput
                                id="email"
                                v-model="form.email"
                                type="email"
                                class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                required
                                autofocus
                            />
                            <JetInputError :message="form.errors.email" />
                        </div>

                        <div>
                            <JetLabel for="password" value="Password" />
                            <JetInput
                                id="password"
                                v-model="form.password"
                                type="password"
                                class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                required
                                autocomplete="current-password"
                            />
                            <JetInputError :message="form.errors.password" />
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <JetCheckbox v-model:checked="form.remember" name="remember" class="h-4 w-4 text-sky-600 focus:ring-sky-500 border-gray-300 rounded" />
                                <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember me</label>
                            </div>

                            <div class="text-sm">
                                <Link :href="route('password.request')" class="font-medium text-sky-600 hover:text-sky-500">Forgot your password?</Link>
                            </div>
                        </div>

                        <div>
                            <JetButton class="w-full flex items-center justify-center bg-gradient-to-r from-sky-400 to-blue-600 bg-origin-border px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white hover:from-sky-700 hover:to-blue-700" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Sign in
                            </JetButton>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </AppLayout>
</template>
