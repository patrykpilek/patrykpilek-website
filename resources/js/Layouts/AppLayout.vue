<script setup>
import { Inertia } from '@inertiajs/inertia';
import { Head } from '@inertiajs/inertia-vue3';
import JetBanner from '@/Components/Banner.vue';
import Navbar from '@/Layouts/Navbar.vue';
import Footer from '@/Layouts/Footer.vue';

defineProps({
    title: String,
});

const logout = () => {
    Inertia.post(route('logout'));
};
</script>

<template>
    <div>
        <Head :title="title" />

        <JetBanner />

        <div class="bg-white">
            <!-- Nav Page -->
            <nav v-if="$slots.nav" >
                <Navbar />
            </nav>

            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white" aria-labelledby="header-heading">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main aria-labelledby="main-heading">
                <slot />
            </main>

            <!-- Footer Page -->
            <footer v-if="$slots.footer" class="bg-withe" aria-labelledby="footer-heading">
                <Footer />
            </footer>
        </div>
    </div>
</template>
