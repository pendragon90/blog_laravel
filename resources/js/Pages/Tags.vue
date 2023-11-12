<script setup>
import Tag from '@/Components/Tag.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps(['tagsPage'])
</script>

<template>
    <AppLayout>
        <div class="flex flex-wrap gap-5 pt-20">
            <div v-for="tag in tagsPage.data" class="flex gap-3 border border-slate-500 rounded-lg p-3">
                <Tag :href="route('tags.page.show', tag.slug)">{{ tag.title }}</Tag>
                <h1 class="text-slate-600">{{ tag.posts.length }} posts</h1>
            </div>
        </div>
    </AppLayout>
</template>