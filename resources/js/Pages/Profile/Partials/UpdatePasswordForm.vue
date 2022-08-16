<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import JetActionMessage from '@/Components/ActionMessage.vue';
import JetButton from '@/Components/Button.vue';
import JetInput from '@/Components/Input.vue';
import JetInputError from '@/Components/InputError.vue';
import JetLabel from '@/Components/Label.vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('user-password.update'), {
        errorBag: 'updatePassword',
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }

            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <form @submit.prevent="updatePassword">
        <!-- Update password -->
        <div class="py-6 px-4 sm:p-6 lg:pb-8">

            <div>
                <h2 class="text-lg leading-6 font-medium text-gray-900">Update Password</h2>
                <p class="mt-1 text-sm text-gray-500">Ensure your account is using a long, random password to stay secure.</p>
            </div>

            <div class="mt-6 grid grid-cols-12 gap-6">
                <div class="col-span-12 sm:col-span-8">
                    <JetLabel for="current_password" value="Current Password" />
                    <JetInput
                        id="current_password"
                        ref="currentPasswordInput"
                        v-model="form.current_password"
                        type="password"
                        class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        autocomplete="current-password"
                    />
                    <JetInputError :message="form.errors.current_password" class="mt-2" />
                </div>

                <div class="col-span-12 sm:col-span-8">
                    <JetLabel for="password" value="New Password" />
                    <JetInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        autocomplete="new-password"
                    />
                    <JetInputError :message="form.errors.password" class="mt-2" />
                </div>

                <div class="col-span-12 sm:col-span-8">
                    <JetLabel for="password_confirmation" value="Confirm Password" />
                    <JetInput
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        autocomplete="new-password"
                    />
                    <JetInputError :message="form.errors.password_confirmation" class="mt-2" />
                </div>

            </div>
        </div>

        <div class="pt-6 divide-y divide-gray-200">
            <div class="px-4 sm:px-6">

            </div>
            <div class="mt-4 py-4 px-4 flex items-center justify-end sm:px-6">
                <JetActionMessage :on="form.recentlySuccessful" class="mr-3 content-center">
                    Saved.
                </JetActionMessage>

                <JetButton
                    class="flex items-center justify-center bg-gradient-to-r from-sky-400 to-blue-600 bg-origin-border px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:from-sky-700 hover:to-blue-700"
                    :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save
                </JetButton>
            </div>
        </div>
    </form>
</template>
