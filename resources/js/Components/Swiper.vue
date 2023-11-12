<template>
    <swiper :slides-per-view="4" :space-between="50" @swiper="onSwiper" @slideChange="onSlideChange">
        <slot />
        <swiper-slide v-for="slide in slides">{{ slide }}</swiper-slide>
        ...
    </swiper>
</template>
<script setup>
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from 'swiper/vue';

// Import Swiper styles
import 'swiper/css';

defineProps(['slides'])

const onSwiper = (swiper) => {
    console.log(swiper);
};
const onSlideChange = () => {
    console.log('slide change');
};

</script>