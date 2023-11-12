<template>
    <Link :href="href" class="px-3 py-1.5 w-max border border-theme hover:bg-theme hover:text-white rounded-full">
    <slot />
    </Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps(['href'])
</script>