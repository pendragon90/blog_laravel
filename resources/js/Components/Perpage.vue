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
    value: {
        type: Number,
        default: ''
    },
    datas: {
        type: Array,
        default: [10, 20, 30, 50, 100]
    },
})
</script>

<template>
    <Listbox as='div' class='relative' :value="value">
        <label for="">{{ label }}</label>
        <ListboxButton
            class="flex items-center justify-between py-2 px-2.5 w-full border border-slate-400 rounded-lg hover:ring-1 hover:ring-green-500 hover:border-green-400 hover:shadow-md hover:shadow-green-300">
            <h1>{{ value }}</h1>
        </ListboxButton>
        <ListboxOptions :id="name" :name="name" class='absolute z-[11] top-full bg-white rounded-lg border border-slate-400 mt-3 flex flex-col gap-2
                hover:ring-1 hover:ring-green-500 hover:border-green-400 hover:shadow-md hover:shadow-green-300'>
            <ListboxOption v-for="data in datas" :key="data.id" :value="data"
                class='hover:text-white hover:bg-green-400 px-3 py-1.5 cursor-pointer'>
                {{ data }}
            </ListboxOption>
        </ListboxOptions>
    </Listbox>
</template>