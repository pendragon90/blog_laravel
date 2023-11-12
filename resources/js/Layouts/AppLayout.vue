<template>
    <Navbar />
    <div class="px-5 lg:px-16 lg:py-20 pb-10 lg:w-3/4 lg:mr-auto">
        <slot />
    </div>
</template>

<script setup>
import Navbar from '@/Components/Navbar.vue';

</script>