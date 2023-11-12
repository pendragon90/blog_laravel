<script setup>
import ButtonForm from '@/Components/ButtonForm.vue';
import Input from '@/Components/Input.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { router, useForm } from '@inertiajs/vue3';

const form = useForm({
    title: '',
})

const submit = () => {
    router.post(route('tags.index', form))
}
</script>

<template>
    <DashboardLayout>
        <div class="mx-auto py-20 max-w-2xl">
            <form @submit.prevent="submit">
                <Input v-model="form.title" :value="form.title" label="Title :" name="title" type="text" />
                <ButtonForm>Create</ButtonForm>
            </form>
        </div>
    </DashboardLayout>
</template>