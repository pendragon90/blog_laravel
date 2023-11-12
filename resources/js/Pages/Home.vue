<template>
    <AppLayout>
        <div class="h-screen flex items-start">
            <div class="flex flex-col gap-5 mt-44 h-full flex-wrap">
                <div class="flex flex-col gap-2 text-primary">
                    <h1 class="text-5xl font-extrabold ">GeekVerse Blog</h1>
                    <h1 class="text-4xl font-extrabold">Technology,Anime,K-Drama,and Coding Insights</h1>
                </div>
                <p class="text-lg font-medium text-justify">Welcome to GeekVerse! Discover the latest updates on technology,
                    anime
                    reviews, Korean drama insights,
                    and
                    programming knowledge</p>
            </div>
        </div>
        <TabGroup as="div" class="pt-20">
            <TabList class="flex justify-between text-lg mb-5">
                <!-- swiper start -->
                <swiper :slides-per-view="4" :space-between="50" @swiper="onSwiper" @slideChange="onSlideChange">
                    <swiper-slide v-for="category in categories.data">
                        <Tab v-slot="{ selected }" class="focus:outline-none">
                            <h1 class="hover:text-theme"
                                :class="selected ? 'text-theme border-b-2 border-b-theme' : 'text-black'">
                                {{ category.title }}</h1>
                        </Tab>
                    </swiper-slide>
                    ...
                </swiper>
                <!-- swiper end -->
            </TabList>
            <TabPanels>
                <TabPanel v-for="category in categories.data" class="grid grid-cols-1 lg:grid-cols-2 gap-y-10 gap-x-5">
                    <CardPost v-for="post in category.posts" :href="route('home.post.show', post.slug)" :title="post.title"
                        :user="post.user" :category="post.category.title" :tags="post.tags" :date="post.date" />
                </TabPanel>
            </TabPanels>
        </TabGroup>
    </AppLayout>
</template>
  
<script setup>
import CardPost from '@/Components/CardPost.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue'
import { Link, router, useForm } from '@inertiajs/vue3';

import { Swiper, SwiperSlide } from 'swiper/vue';

// Import Swiper styles
import 'swiper/css';

const onSwiper = (swiper) => {
    console.log(swiper);
};
const onSlideChange = () => {
    console.log('slide change');
};

defineProps([
    'posts',
    'categories'
])

</script>