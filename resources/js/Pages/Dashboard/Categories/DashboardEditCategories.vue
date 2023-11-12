<script setup>
import ButtonForm from '@/Components/ButtonForm.vue';
import Input from '@/Components/Input.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    singleCategory: Object
})

const form = useForm({
    title: props.singleCategory.data.title,
})

const submit = () => {
    form.transform(data => ({
        ...data,
        _method: 'PUT'
    })).post(route('categories.update', props.singleCategory.data))
}
</script>

<template>
    <DashboardLayout>
        <div class="mx-auto py-20 max-w-2xl">
            <form @submit.prevent="submit">
                <Input v-model="form.title" :value="form.title" label="Title :" name="title" type="text" />
                <ButtonForm>Edit</ButtonForm>
            </form>
        </div>
    </DashboardLayout>
</template>