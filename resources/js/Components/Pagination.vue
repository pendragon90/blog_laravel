<script setup>
defineProps({
    meta: Array,
    current_page: Number
})
</script>

<template>
    <div class='flex items-center justify-center'>
        <div class="flex justify-center items-center">
            <template v-for="link in meta">
                <Link v-if="link.url" :href="link.url" v-html="link.label" class='hover:bg-theme hover:text-primary
                        px-3 py-1.5 border border-theme' :class="[current_page == link.label ? 'bg-theme text-white' : 'bg-transparent text-theme',
                        link.label == 'Previous' ? 'rounded-s-xl' : '',
                        link.label == 'Next' ? 'rounded-e-xl' : ''
                        ]" />
                <span v-else class="hidden" />
            </template>
        </div>
    </div>
</template>