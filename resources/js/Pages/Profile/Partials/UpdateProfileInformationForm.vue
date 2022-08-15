<script setup>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Link, useForm } from '@inertiajs/inertia-vue3';
import JetButton from '@/Components/Button.vue';
import JetInput from '@/Components/Input.vue';
import JetInputError from '@/Components/InputError.vue';
import JetLabel from '@/Components/Label.vue';
import JetActionMessage from '@/Components/ActionMessage.vue';

const props = defineProps({
    user: Object,
});

const form = useForm({
    _method: 'PUT',
    name: props.user.name,
    first_name: null,
    last_name: null,
    email: props.user.email,
    about: null,
    photo: null,
});

const verificationLinkSent = ref(null);
const photoPreview = ref(null);
const photoInput = ref(null);

const updateProfileInformation = () => {
    if (photoInput.value) {
        form.photo = photoInput.value.files[0];
    }

    form.post(route('user-profile-information.update'), {
        errorBag: 'updateProfileInformation',
        preserveScroll: true,
        onSuccess: () => clearPhotoFileInput(),
    });
};

const sendEmailVerification = () => {
    verificationLinkSent.value = true;
};

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (! photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};

const deletePhoto = () => {
    Inertia.delete(route('current-user-photo.destroy'), {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            clearPhotoFileInput();
        },
    });
};

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};
</script>

<template>
    <form @submit.prevent="updateProfileInformation">
        <!-- Profile section -->
        <div class="py-6 px-4 sm:p-6 lg:pb-8">

            <div>
                <h2 class="text-lg leading-6 font-medium text-gray-900">Profile Information</h2>
                <p class="mt-1 text-sm text-gray-500">Update your account's profile information, email address and photo.</p>
            </div>

            <div class="mt-6 flex flex-col lg:flex-row">

                <!-- Profile Photo File Input -->
                <input
                    ref="photoInput"
                    type="file"
                    class="hidden"
                    @change="updatePhotoPreview"
                >

                <div class="flex-grow space-y-6">
                    <div>
                        <JetLabel for="name" value="Name" />
                        <JetInput
                            id="name"
                            v-model="form.name"
                            type="text"
                            class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            autocomplete="name"
                        />
                        <JetInputError :message="form.errors.name" class="mt-2" />
                    </div>

                    <div>
                        <JetLabel for="about" value="About" />
                        <div class="mt-1">
                            <textarea id="about" v-model="form.about" rows="5" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"></textarea>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">Brief description for your profile.</p>
                    </div>
                </div>

                <div class="mt-6 flex-grow lg:mt-0 lg:ml-6 lg:flex-grow-0 lg:flex-shrink-0">
                    <p class="text-sm font-medium text-gray-700" aria-hidden="true">Photo</p>
                    <!-- Mobile -->
                    <div class="mt-1 lg:hidden">
                        <div class="flex items-center">
                            <div v-show="! photoPreview" class="flex-shrink-0 inline-block rounded-full overflow-hidden h-12 w-12" aria-hidden="true">
                                <img class="rounded-full h-full w-full" :src="user.profile_photo_url" :alt="user.name" />
                            </div>
                            <div v-show="photoPreview" class="flex-shrink-0 inline-block rounded-full overflow-hidden h-12 w-12" aria-hidden="true">
                                <span class="block rounded-full w-12 h-12 bg-cover bg-no-repeat bg-center" :style="'background-image: url(\'' + photoPreview + '\');'" />
                            </div>
                            <div class="ml-5 rounded-md shadow-sm">
                                <div @click.prevent="selectNewPhoto" class="group relative border border-gray-300 rounded-md py-2 px-3 flex items-center justify-center hover:bg-gray-50 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-sky-500">
                                    <label for="mobile-user-photo" class="relative text-sm leading-4 font-medium text-gray-700 pointer-events-none">
                                        <span>Change</span>
                                        <span class="sr-only"> user photo</span>
                                    </label>
                                </div>
                            </div>
                            <div v-if="user.profile_photo_path" class="ml-2 rounded-md shadow-sm">
                                <div @click.prevent="deletePhoto" class="group relative border border-gray-300 rounded-md py-2 px-3 flex items-center justify-center hover:bg-gray-50 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-sky-500">
                                    <label for="mobile-user-photo" class="relative text-sm leading-4 font-medium text-gray-700 pointer-events-none">
                                        <span>Remove</span>
                                        <span class="sr-only"> remove photo</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Desktop -->
                    <div class="hidden relative rounded-full overflow-hidden lg:block">
                        <!-- Current Profile Photo -->
                        <div v-show="! photoPreview">
                            <img class="relative rounded-full w-40 h-40" :src="user.profile_photo_url" :alt="user.name" />
                        </div>

                        <!-- New Profile Photo Preview -->
                        <div v-show="photoPreview">
                            <span class="block rounded-full w-40 h-40 bg-cover bg-no-repeat bg-center" :style="'background-image: url(\'' + photoPreview + '\');'" />
                        </div>

                        <div @click.prevent="selectNewPhoto">
                            <label for="desktop-user-photo" class="absolute inset-0 w-full h-full bg-black bg-opacity-75 flex items-center justify-center text-sm font-medium text-white opacity-0 hover:opacity-100 focus-within:opacity-100">
                                <span>Change</span>
                                <span class="sr-only"> user photo</span>
                            </label>
                        </div>
                    </div>

                    <div v-if="user.profile_photo_path" class="mt-2 invisible lg:visible rounded-md shadow-sm">
                        <div @click.prevent="deletePhoto" class="group relative border border-gray-300 rounded-md py-2 px-3 flex items-center justify-center hover:bg-gray-50 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-sky-500">
                            <label for="desktop-user-photo" class="relative text-sm leading-4 font-medium text-gray-700 pointer-events-none">
                                <span>Remove</span>
                                <span class="sr-only"> remove photo</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-12 gap-6">
                <div class="col-span-12 sm:col-span-6">
                    <JetLabel for="first_name" value="First name" />
                    <JetInput
                        id="last_name"
                        v-model="form.first_name"
                        type="text"
                        class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        autocomplete="first_name"
                    />
                    <JetInputError :message="form.errors.first_name" class="mt-2" />
                </div>

                <div class="col-span-12 sm:col-span-6">
                    <JetLabel for="last_name" value="Last name" />
                    <JetInput
                        id="last_name"
                        v-model="form.last_name"
                        type="text"
                        class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        autocomplete="last_name"
                    />
                    <JetInputError :message="form.errors.last_name" class="mt-2" />
                </div>

                <div class="col-span-12">
                    <JetLabel for="email" value="Email" />
                    <JetInput
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        autocomplete="email"
                    />
                    <JetInputError :message="form.errors.email" class="mt-2" />

                    <div v-if="$page.props.jetstream.hasEmailVerification && user.email_verified_at === null">
                        <p class="text-sm mt-2">
                            Your email address is unverified.

                            <Link
                                :href="route('verification.send')"
                                method="post"
                                as="button"
                                class="underline text-gray-600 hover:text-gray-900"
                                @click.prevent="sendEmailVerification"
                            >
                                Click here to re-send the verification email.
                            </Link>
                        </p>

                        <div v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                            A new verification link has been sent to your email address.
                        </div>
                    </div>
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

                <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save
                </JetButton>
            </div>
        </div>
    </form>
</template>
