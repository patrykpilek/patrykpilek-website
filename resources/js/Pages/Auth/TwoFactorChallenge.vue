<script setup>
import { nextTick, ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import JetButton from '@/Components/Button.vue';
import JetInput from '@/Components/Input.vue';
import JetLabel from '@/Components/Label.vue';
import JetInputError from '@/Components/InputError.vue';

const recovery = ref(false);

const form = useForm({
    code: '',
    recovery_code: '',
});

const recoveryCodeInput = ref(null);
const codeInput = ref(null);

const toggleRecovery = async () => {
    recovery.value ^= true;

    await nextTick();

    if (recovery.value) {
        recoveryCodeInput.value.focus();
        form.code = '';
    } else {
        codeInput.value.focus();
        form.recovery_code = '';
    }
};

const submit = () => {
    form.post(route('two-factor.login'));
};
</script>

<template>
    <AppLayout title="Two-factor Confirmation">
        <template #nav></template>

        <div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-md">
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Two-factor Confirmation</h2>
            </div>

            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                <div class="bg-white py-8 px-4 shadow-2xl shadow-blue-500/50 sm:rounded-lg sm:px-10">

                    <div class="mb-4 text-sm text-gray-600">
                        <template v-if="! recovery">
                            Please confirm access to your account by entering the authentication code provided by your authenticator application.
                        </template>

                        <template v-else>
                            Please confirm access to your account by entering one of your emergency recovery codes.
                        </template>
                    </div>

                    <form @submit.prevent="submit" class="space-y-6">
                        <div v-if="! recovery">
                            <JetLabel for="code" value="Code" />
                            <JetInput
                                id="code"
                                ref="codeInput"
                                v-model="form.code"
                                type="text"
                                inputmode="numeric"
                                class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                autofocus
                                autocomplete="one-time-code"
                            />
                        </div>

                        <div v-else>
                            <JetLabel for="recovery_code" value="Recovery Code" />
                            <JetInput
                                id="recovery_code"
                                ref="recoveryCodeInput"
                                v-model="form.recovery_code"
                                type="text"
                                class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                autocomplete="one-time-code"
                            />
                        </div>

                        <JetInputError :message="form.errors.code" />

                        <div class="flex items-center justify-end mt-4">
                            <button type="button" class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer" @click.prevent="toggleRecovery">
                                <template v-if="! recovery">
                                    Use a recovery code
                                </template>

                                <template v-else>
                                    Use an authentication code
                                </template>
                            </button>

                            <JetButton class="ml-4 flex items-center justify-center bg-gradient-to-r from-sky-400 to-blue-600 bg-origin-border px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:from-sky-700 hover:to-blue-700" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Log in
                            </JetButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </AppLayout>
</template>
