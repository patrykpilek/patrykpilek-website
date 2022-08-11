<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import { Popover, PopoverButton, PopoverGroup, PopoverPanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
import { AnnotationIcon, HomeIcon, ClipboardListIcon, MenuIcon, XIcon } from '@heroicons/vue/outline';
import JetButton from '@/Components/Button.vue';

const logout = () => {
    Inertia.post(route('logout'));
};
</script>

<template>
    <header>
        <Popover class="relative bg-white">
            <div class="flex justify-between items-center max-w-7xl mx-auto px-4 py-6 sm:px-6 md:justify-start md:space-x-10 lg:px-8">
                <div class="flex justify-start lg:w-0 lg:flex-1">
                    <Link :href="route('home')">
                        <span class="sr-only">Logo</span>
                        <img class="h-8 w-auto sm:h-10" :src="'../storage/images/logo.png'" alt="logo" />
                    </Link>
                </div>
                <div class="-mr-2 -my-2 md:hidden">
                    <PopoverButton class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                        <span class="sr-only">Open menu</span>
                        <MenuIcon class="h-6 w-6" aria-hidden="true" />
                    </PopoverButton>
                </div>
                <PopoverGroup as="nav" class="hidden md:flex space-x-10">
                    <Link :href="route('home')" class="text-base font-medium text-gray-500 hover:text-gray-900">Home</Link>
                    <Link :href="route('blog')" class="text-base font-medium text-gray-500 hover:text-gray-900">Blog</Link>
                    <Link :href="route('contact')" class="text-base font-medium text-gray-500 hover:text-gray-900">Contact</Link>
                </PopoverGroup>
                <div class="hidden md:flex items-center justify-end md:flex-1 lg:w-0">
                    <!-- Profile dropdown -->
                    <Menu v-if="$page.props.user" as="div" class="ml-3 relative">
                        <div>
                            <MenuButton class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name">
                            </MenuButton>
                        </div>
                        <transition enter-active-class="transition ease-out duration-200" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                            <MenuItems class="z-10 origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none">

                                <div class="px-4 py-3">
                                    <p class="block text-xs text-gray-400">Signed in as:</p>
                                    <p class="text-sm font-bold text-gray-900 truncate">{{ $page.props.user.name}}</p>
                                </div>

                                <div class="py-1">
                                    <div class="px-4">
                                        <p class="block text-xs text-gray-400">Manage Account</p>
                                    </div>
                                    <MenuItem v-slot="{ active }">
                                        <Link :href="route('profile.show')" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">
                                            Your Profile
                                        </Link>
                                    </MenuItem>
                                </div>
                                <div class="py-1">
                                    <form method="POST" @submit.prevent="logout">
                                        <MenuItem v-slot="{ active }">
                                            <button type="submit" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block w-full text-left px-4 py-2 text-sm']">Sign out</button>
                                        </MenuItem>
                                    </form>
                                </div>
                            </MenuItems>
                        </transition>
                    </Menu>

                    <template v-else>
                        <Link :href="route('login')" class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900">Sign In</Link>
                        <Link :href="route('register')" class="ml-8 whitespace-nowrap inline-flex items-center justify-center uppercase bg-gradient-to-r from-sky-400 to-blue-600 bg-origin-border px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white hover:from-sky-700 hover:to-blue-700">Sign up</Link>
                    </template>
                </div>
            </div>

            <transition enter-active-class="duration-200 ease-out" enter-from-class="opacity-0 scale-95" enter-to-class="opacity-100 scale-100" leave-active-class="duration-100 ease-in" leave-from-class="opacity-100 scale-100" leave-to-class="opacity-0 scale-95">
                <PopoverPanel focus class="absolute z-30 top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden">
                    <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 bg-white divide-y-2 divide-gray-50">
                        <div class="pt-5 pb-6 px-5">
                            <div class="flex items-center justify-between">
                                <div>
                                    <Link :href="route('home')">
                                        <span class="sr-only">Logo</span>
                                        <img class="h-8 w-auto" :src="'../storage/images/logo.png'" alt="Logo" />
                                    </Link>
                                </div>
                                <div class="-mr-2">
                                    <PopoverButton class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                                        <span class="sr-only">Close menu</span>
                                        <XIcon class="h-6 w-6" aria-hidden="true" />
                                    </PopoverButton>
                                </div>
                            </div>
                            <div class="mt-6">
                                <nav class="grid grid-cols-1 gap-7">
                                    <Link :href="route('home')" class="-m-3 p-3 flex items-center rounded-lg hover:bg-gray-50">
                                        <div class="flex-shrink-0 flex items-center justify-center h-10 w-10 rounded-md bg-gradient-to-r from-sky-400 to-blue-600 text-white">
                                            <HomeIcon class="h-6 w-6" aria-hidden="true" />
                                        </div>
                                        <div class="ml-4 text-base font-medium text-gray-900">
                                            Home
                                        </div>
                                    </Link>
                                    <Link :href="route('blog')" class="-m-3 p-3 flex items-center rounded-lg hover:bg-gray-50">
                                        <div class="flex-shrink-0 flex items-center justify-center h-10 w-10 rounded-md bg-gradient-to-r from-sky-400 to-blue-600 text-white">
                                            <ClipboardListIcon class="h-6 w-6" aria-hidden="true" />
                                        </div>
                                        <div class="ml-4 text-base font-medium text-gray-900">
                                            Blog
                                        </div>
                                    </Link>
                                    <Link :href="route('contact')" class="-m-3 p-3 flex items-center rounded-lg hover:bg-gray-50">
                                        <div class="flex-shrink-0 flex items-center justify-center h-10 w-10 rounded-md bg-gradient-to-r from-sky-400 to-blue-600 text-white">
                                            <AnnotationIcon class="h-6 w-6" aria-hidden="true" />
                                        </div>
                                        <div class="ml-4 text-base font-medium text-gray-900">
                                            Contact
                                        </div>
                                    </Link>
                                </nav>
                            </div>
                        </div>
                        <div class="py-6 px-5">

                            <div v-if="$page.props.user">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <img class="h-10 w-10 rounded-full" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name">
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-base font-medium text-gray-800">{{ $page.props.user.name }}</div>
                                        <div class="text-sm font-medium text-gray-500">{{ $page.props.user.email }}</div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4 mt-6">
                                    <Link :href="route('profile.show')" class="text-base font-medium text-gray-900 hover:text-gray-700">Your Profile</Link>
                                </div>
                                <div class="mt-6">
                                    <form method="POST" @submit.prevent="logout">
                                        <JetButton class="w-full flex items-center justify-center bg-gradient-to-r from-sky-400 to-blue-600 bg-origin-border px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:from-sky-700 hover:to-blue-700">Log Out</JetButton>
                                    </form>
                                </div>
                            </div>

                            <div v-else>
                                <div class="mt-6">
                                    <Link :href="route('login')" class="w-full flex items-center justify-center bg-gradient-to-r from-sky-400 to-blue-600 bg-origin-border px-4 py-2 border border-transparent rounded-md shadow-sm text-sm uppercase font-medium text-white hover:from-sky-700 hover:to-blue-700">Sign In</Link>
                                    <p class="mt-6 text-center text-base font-medium text-gray-500">
                                        Don't have an account yet?
                                        <Link :href="route('register')" class="text-gray-900">Sign Up</Link>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </PopoverPanel>
            </transition>
        </Popover>
    </header>
</template>

