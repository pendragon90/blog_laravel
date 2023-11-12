<script setup>
import { Link } from '@inertiajs/vue3';

defineProps(['href'])
</script>

<template>
    <Link :href="href" class="px-2 py-0.5 bg-green-100 rounded-full w-max"><span class="text-green-600">#</span>
    <slot />
    </Link>
</template>