<script setup>
import {
    Listbox,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
} from '@headlessui/vue'

defineProps({
    label: String,
    name: String,
    selectedValue: Object,
    datas: Array,
})
</script>

<template>
    <Listbox as='div' class='relative mb-4'>
        <h1>{{ label }}</h1>
        <ListboxButton
            class="flex items-center justify-between py-2 px-2.5 w-full border border-theme rounded-lg hover:ring-1 hover:ring-theme hover:border-theme hover:shadow-md hover:shadow-green-300">
            <h1>{{ selectedValue.title }}</h1>
        </ListboxButton>
        <ListboxOptions :id="name" :name="name" class='absolute z-[11] top-full bg-white rounded-lg border border-theme flex flex-col gap-2
                hover:ring-1 hover:ring-theme hover:border-theme hover:shadow-md hover:shadow-green-300'>
            <ListboxOption v-for="data in datas" :key="data.id" :value="data"
                class='hover:text-white hover:bg-theme px-3 py-1.5 cursor-pointer'>
                {{ data.title }}
            </ListboxOption>
        </ListboxOptions>
    </Listbox>
</template>