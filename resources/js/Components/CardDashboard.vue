<script setup>
defineProps(['total'])
</script>

<template>
    <div class="bg-white col-span-6 lg:col-span-3 h-max font-bold flex flex-col justify-start gap-3 border p-5 rounded-xl">
        <h1 class="text-xl font-bold text-slate-500">
            <slot />
        </h1>
        <h1 class="text-3xl font-bold text-primary">{{ total }}</h1>
    </div>
</template>