<script setup>
defineProps({
    class: String,
    name: String,
    label: String,
    type: String,
    value: String,
    placeholder: String,
    modelValue: String
})

const emits = defineEmits(['update:modelValue'])
</script>

<template>
    <div class="mb-4 flex flex-col" :class="class">
        <label :for="name">{{ label }}</label>
        <input :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" :type="type" :id="name"
            :name="name" :placeholder="placeholder" class="border border-slate-400 rounded-lg lg:py-2 lg:px-3 file:px-2.5 file:py-2 file:border-0 file:mr-3
                hover:ring-1 hover:ring-theme hover:shadow-md hover:shadow-blue-300
                focus:ring-1 focus:ring-theme focus:shadow-md focus:shadow-blue-300
                focus:outline-none" />
    </div>
</template>