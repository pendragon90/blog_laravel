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
    value: String,
    datas: Array,
})
</script>

<template>
    <div class="flex flex-col">
        <label for="">{{ label }}</label>
        <Listbox as='div' class='relative'>
            <ListboxButton
                class="flex items-center justify-between py-2 px-2.5 w-full border border-slate-400 rounded-lg hover:ring-1 hover:ring-green-500 hover:border-green-400 hover:shadow-md hover:shadow-green-300">
                <h1>{{ value.title ?? 'All' }}</h1>
            </ListboxButton>
            <ListboxOptions :id="name" :name="name" class='absolute z-[11] top-full bg-white rounded-lg border border-slate-400 w-max grid grid-cols-2 lg:grid-cols-3 gap-2
                hover:ring-1 hover:ring-green-500 hover:border-green-400 hover:shadow-md hover:shadow-green-300'>
                <ListboxOption value="All" class='hover:text-white hover:bg-green-400 px-3 py-1.5 cursor-pointer'>
                    All
                </ListboxOption>
                <ListboxOption v-for="data in datas" :key="data.id" :value="data"
                    class='hover:text-white hover:bg-green-400 px-3 py-1.5 cursor-pointer'>
                    {{ data.title }}
                </ListboxOption>
            </ListboxOptions>
        </Listbox>
    </div>
</template>
