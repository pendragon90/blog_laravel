<script setup>
import CardPost from '@/Components/CardPost.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps(['tagPage'])
</script>

<template>
    <AppLayout>
        <div class="flex flex-wrap gap-5 pt-20">
            <div class="flex flex-col gap-10">
                <CardPost v-for="post in tagPage.data.posts" :title="post.title" :user="post.user"
                    :category="post.category.title" :tags="post.tags" :date="post.date" />
            </div>
        </div>
    </AppLayout>
</template>