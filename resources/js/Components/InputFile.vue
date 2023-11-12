<template>
    <div class="mb-4 flex flex-col gap-3 lg:w-1/2 w-full">
        <label :for="name">{{ label }}</label>
        <img :src="srcImg || oldImg" v-if="srcImg || oldImg" alt="" :class="{ 'h-52 w-40': srcImg || oldImg }">
        <input type="file" @change="previewImg" @input="updateImgValue.img = $event.target.files[0]" :id="name" :name="name"
            :placeholder="placeholder" class="border border-slate-400 rounded-lg file:px-4 file:py-3 file:border-0 file:mr-3
                hover:ring-1 hover:ring-theme hover:border-theme hover:shadow-md hover:shadow-green-300
                focus:ring-1 focus:ring-theme focus:border-theme focus:shadow-md focus:shadow-green-300
                focus:outline-none" />
    </div>
</template>

<script setup>
defineProps([
    'oldImg',
    'srcImg',
    'previewImg',
    'name',
    'label',
    'type',
    'value',
    'placeholder',
    'updateImgValue'
])
</script>
