<script setup>
import {
    Listbox,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
} from '@headlessui/vue'

import { defineProps } from 'vue'

const props = defineProps({
    label: String,
    name: String,
    selectedValue: Array,
    datas: Array,
})

const removeSelected = (i) => {
    props.selectedValue.splice(i, 1)
}
</script>

<template>
    <Listbox as="div" class="relative mb-4" multiple>
        <h1>{{ label }}</h1>
        <ListboxButton
            class="flex items-center justify-between py-2 px-2.5 w-full border border-theme rounded-lg hover:ring-1 hover:ring-theme hover:border-theme hover:shadow-md hover:shadow-theme">
            <h1>Selected : {{ selectedValue.length }}</h1>
        </ListboxButton>

        <div class="flex flex-wrap gap-3 my-3">
            <div v-for="selected in selectedValue" :key="selected.id" @click="removeSelected(selected)"
                class="flex gap-1 items-center bg-theme hover:bg-red-500 text-white w-max cursor-pointer rounded-lg px-3 py-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
                <h1>{{ selected.title }}</h1>
            </div>
        </div>

        <ListboxOptions :id="name" :name="name"
            class="grid lg:grid-cols-4 gap-3 mt-2 absolute z-[11] top-full bg-white rounded-lg border border-theme hover:ring-1 hover:ring-theme hover:border-theme hover:shadow-md hover:shadow-theme">
            <ListboxOption v-for="data in datas" :key="data.id" :value="data">
                <div class="flex items-center gap-1 hover:text-white hover:bg-theme px-3 py-1.5 cursor-pointer"
                    :class="{ 'bg-theme text-white': selectedValue.some(item => item.id === data.id) }">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"
                        :class="{ 'text-transparent': !selectedValue.some(item => item.id === data.id) }">
                        <path fill-rule="evenodd"
                            d="M16.403 12.652a3 3 0 000-5.304 3 3 0 00-3.75-3.751 3 3 0 00-5.305 0 3 3 0 00-3.751 3.75 3 3 0 000 5.305 3 3 0 003.75 3.751 3 3 0 005.305 0 3 3 0 003.751-3.75zm-2.546-4.46a.75.75 0 00-1.214-.883l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ data.title }}
                </div>
            </ListboxOption>
        </ListboxOptions>
    </Listbox>
</template>
