<script setup>
import {computed} from 'vue';
import {Link, useForm} from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import JetButton from '@/Components/Button.vue';

const props = defineProps({
    status: String,
});

const form = useForm();

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <AppLayout title="Email Verification">
        <template #nav></template>

        <div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-md">
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Email Verification</h2>
            </div>

            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                <div class="bg-white py-8 px-4 shadow-2xl shadow-blue-500/50 sm:rounded-lg ">

                    <div class="mb-4 text-sm text-gray-600">
                        Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive
                        the email, we will gladly send you another.
                    </div>

                    <div v-if="verificationLinkSent" class="mb-4 font-medium text-sm text-green-600">
                        A new verification link has been sent to the email address you provided in your profile settings.
                    </div>

                    <form @submit.prevent="submit" class="space-y-6">
                        <div class="mt-4 flex items-center justify-between">
                            <JetButton
                                class="flex items-center justify-center bg-gradient-to-r from-sky-400 to-blue-600 bg-origin-border px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:from-sky-700 hover:to-blue-700"
                                :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Resend Verification Email
                            </JetButton>

                            <div>
                                <Link :href="route('profile.show')" class="underline text-sm text-gray-600 hover:text-gray-900">
                                    Edit Profile
                                </Link>

                                <Link :href="route('logout')" method="post" as="button"
                                      class="underline text-sm text-gray-600 hover:text-gray-900 ml-2">
                                    Log Out
                                </Link>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </AppLayout>
</template>
