<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
import LogoutOtherBrowserSessionsForm from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue';
import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue';
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue'
import { CogIcon, KeyIcon, UserCircleIcon, FingerPrintIcon, DesktopComputerIcon } from '@heroicons/vue/outline'

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
});
</script>

<template>
    <AppLayout title="Profile">

        <template #nav></template>

        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">Edit Profile</h2>
                </div>
            </div>
        </template>

        <div class="max-w-screen-xl mx-auto pb-6 px-4 sm:px-6 lg:pb-16 lg:px-8">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="divide-y divide-gray-200 lg:grid lg:grid-cols-12 lg:divide-y-0 lg:divide-x">
                    <TabGroup :defaultIndex="0">
                        <aside class="py-6 lg:col-span-3">
                            <TabList>
                                <nav class="space-y-1">
                                    <Tab v-slot="{ selected }" as="template">
                                        <a href="#" :class="[selected ? 'bg-blue-50 border-blue-500 text-blue-700 hover:bg-blue-50 hover:text-blue-700 group border-l-4 px-3 py-2 flex items-center text-sm font-medium' : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900 group border-l-4 px-3 py-2 flex items-center text-sm font-medium']">
                                            <UserCircleIcon :class="[selected ? 'flex-shrink-0 -ml-1 mr-3 h-6 w-6 text-blue-500 group-hover:text-blue-500' : 'flex-shrink-0 -ml-1 mr-3 h-6 w-6 text-gray-400 group-hover:text-gray-500']" aria-hidden="true" />
                                            <span class="truncate">Profile</span>
                                        </a>
                                    </Tab>
                                    <Tab v-slot="{ selected }" as="template">
                                        <a href="#" :class="[selected ? 'bg-blue-50 border-blue-500 text-blue-700 hover:bg-blue-50 hover:text-blue-700 group border-l-4 px-3 py-2 flex items-center text-sm font-medium' : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900 group border-l-4 px-3 py-2 flex items-center text-sm font-medium']">
                                            <KeyIcon :class="[selected ? 'flex-shrink-0 -ml-1 mr-3 h-6 w-6 text-blue-500 group-hover:text-blue-500' : 'flex-shrink-0 -ml-1 mr-3 h-6 w-6 text-gray-400 group-hover:text-gray-500']" aria-hidden="true" />
                                            <span class="truncate">Password</span>
                                        </a>
                                    </Tab>
                                    <Tab v-slot="{ selected }" as="template">
                                        <a href="#" :class="[selected ? 'bg-blue-50 border-blue-500 text-blue-700 hover:bg-blue-50 hover:text-blue-700 group border-l-4 px-3 py-2 flex items-center text-sm font-medium' : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900 group border-l-4 px-3 py-2 flex items-center text-sm font-medium']">
                                            <FingerPrintIcon :class="[selected ? 'flex-shrink-0 -ml-1 mr-3 h-6 w-6 text-blue-500 group-hover:text-blue-500' : 'flex-shrink-0 -ml-1 mr-3 h-6 w-6 text-gray-400 group-hover:text-gray-500']" aria-hidden="true" />
                                            <span class="truncate">Authentication</span>
                                        </a>
                                    </Tab>
                                    <Tab v-slot="{ selected }" as="template">
                                        <a href="#" :class="[selected ? 'bg-blue-50 border-blue-500 text-blue-700 hover:bg-blue-50 hover:text-blue-700 group border-l-4 px-3 py-2 flex items-center text-sm font-medium' : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900 group border-l-4 px-3 py-2 flex items-center text-sm font-medium']">
                                            <DesktopComputerIcon :class="[selected ? 'flex-shrink-0 -ml-1 mr-3 h-6 w-6 text-blue-500 group-hover:text-blue-500' : 'flex-shrink-0 -ml-1 mr-3 h-6 w-6 text-gray-400 group-hover:text-gray-500']" aria-hidden="true" />
                                            <span class="truncate">Sessions</span>
                                        </a>
                                    </Tab>
                                    <Tab v-slot="{ selected }" as="template">
                                        <a href="#" :class="[selected ? 'bg-blue-50 border-blue-500 text-blue-700 hover:bg-blue-50 hover:text-blue-700 group border-l-4 px-3 py-2 flex items-center text-sm font-medium' : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900 group border-l-4 px-3 py-2 flex items-center text-sm font-medium']">
                                            <CogIcon :class="[selected ? 'flex-shrink-0 -ml-1 mr-3 h-6 w-6 text-blue-500 group-hover:text-blue-500' : 'flex-shrink-0 -ml-1 mr-3 h-6 w-6 text-gray-400 group-hover:text-gray-500']" aria-hidden="true" />
                                            <span class="truncate">Account</span>
                                        </a>
                                    </Tab>
                                </nav>
                            </TabList>
                        </aside>

                        <div class="divide-y divide-gray-200 lg:col-span-9">
                            <TabPanels>
                                <TabPanel>
                                    <UpdateProfileInformationForm :user="$page.props.user" />
                                </TabPanel>

                                <TabPanel>
                                    <UpdatePasswordForm class="mt-10 sm:mt-0" />
                                </TabPanel>

                                <TabPanel>
                                    <TwoFactorAuthenticationForm :requires-confirmation="confirmsTwoFactorAuthentication" class="mt-10 sm:mt-0" />
                                </TabPanel>

                                <TabPanel>
                                    <LogoutOtherBrowserSessionsForm :sessions="sessions" class="mt-10 sm:mt-0" />
                                </TabPanel>

                                <TabPanel>
                                    <DeleteUserForm class="mt-10 sm:mt-0" />
                                </TabPanel>
                            </TabPanels>

                        </div>
                    </TabGroup>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
