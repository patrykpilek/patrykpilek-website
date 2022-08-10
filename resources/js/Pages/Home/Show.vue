<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

</script>

<template>
    <AppLayout title="Home">

        <template #nav></template>

        <!-- Hero section -->
        <div class="relative">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="relative shadow-xl mt-10 lg:mt-20 sm:rounded-2xl sm:overflow-hidden">
                    <div class="blur-sm absolute inset-0">
                        <img class="h-full w-full object-cover" :src="'storage/images/home_img.jpg'" alt="hero image" />
                        <div class="absolute inset-0 bg-gradient-to-r from-white to-blue-600 bg-origin-border mix-blend-multiply" />
                    </div>
                    <div class="relative px-4 py-16 sm:px-6 sm:py-24 lg:py-32 lg:px-8">
                        <h1 class="text-center text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl">
                            <span class="block text-white">&ldquo;Have no fear of perfection</span>
                            <span class="block text-indigo-200">- you'll never reach it.&ldquo;</span>
                        </h1>
                        <p class="mt-6 max-w-lg mx-auto text-center text-xl text-indigo-200 sm:max-w-3xl">&ldquo;Intelligence without ambition is a bird without wings.&ldquo;</p>
                        <div class="mt-10 mx-auto max-w-none flex justify-center">
                            <div class="space-y-4 sm:space-y-0 mx-auto">
                                <p class="max-w-lg mx-auto text-center text-md text-white sm:max-w-3xl">- Salvador Dali</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>
</template>
