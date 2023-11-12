<script setup>
import NavbarDashboard from '@/Components/NavbarDashboard.vue';
</script>

<template>
    <NavbarDashboard />
    <div id="scrollToTop" class="pt-20 pb-10 px-7 w-full lg:w-4/5 lg:ml-auto">
        <slot />
    </div>
</template>