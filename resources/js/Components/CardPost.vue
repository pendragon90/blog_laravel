<script setup>
import { Link } from '@inertiajs/vue3';
import Tag from './Tag.vue';

defineProps(['title', 'category', 'tags', 'user', 'date', 'href', 'totalLikes', 'handleLike'])
defineEmits(['modelLike', 'addLike'])
</script>

<template>
    <div class="flex flex-col gap-4">

        <Link :href="href" class="relative">
        <div class="rounded-xl absolute -bottom-2.5 right-2 z-10">
            <h1
                class="px-4 py-2 w-max bg-violet-600 text-violet-200 hover:text-violet-600 hover:bg-violet-200 rounded-full">
                {{ category }}</h1>
        </div>
        <div class="rounded-xl overflow-hidden">
            <img class="hover:scale-110 transition w-full"
                src="https://www.travelandleisure.com/thmb/kfcKH88gBt_d1ZJPFg_rUcyMekU=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/TAL-grand-teton-USMNTNSIPOG0823-2538d183b9094e3fb59dd5e54bbe791c.jpg"
                alt="">
        </div>
        </Link>

        <!-- uploader start -->
        <div class="flex items-center gap-2">
            <div class="rounded-full overflow-hidden h-9 w-9 border border-primary">
                <img src="https://cdn-icons-png.flaticon.com/128/236/236831.png" alt="">
            </div>
            <div class="flex flex-col">
                <h1 class="font-medium">{{ user }}</h1>
                <span class="text-sm">{{ date }}</span>
            </div>
        </div>
        <!-- uploader end -->

        <div class="">
            <h1 class="font-extrabold text-xl">{{ title }}</h1>

            <div class="flex gap-2 flex-wrap mt-1.5">
                <Tag v-for="tag in tags">{{ tag.title }}</Tag>
            </div>
        </div>

    </div>
</template>