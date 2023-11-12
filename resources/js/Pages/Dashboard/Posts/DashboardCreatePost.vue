<script setup>
import Input from '@/Components/Input.vue';
import InputFile from '@/Components/InputFile.vue';
import Select from '@/Components/Select.vue';
import MultipleSelect from '@/Components/MultipleSelect.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import ButtonForm from '@/Components/ButtonForm.vue';

const props = defineProps({
    categories: Object,
    tags: Object
})

const srcPreviewImg = ref(null)

const form = useForm({
    title: '',
    img: null,
    category_id: props.categories.data[0],
    tags: [props.tags.data[0]],
    content: ''
})

const submit = () => {
    form.transform(data => ({
        ...data,
        category_id: form.category_id.id,
        tags: form.tags.map(tag => tag.id)
    })).post(route('posts.index'))
}

const handlePreviewImg = (e) => {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (event) => {
            srcPreviewImg.value = event.target.result;
        };
        reader.readAsDataURL(file);
    }
};
</script>

<template>
    <DashboardLayout>
        <form @submit.prevent="submit">
            <Input v-model="form.title" :value="form.title" label="Title :" name="title" type="text" />

            <InputFile label="Image :" name="img" type="file" :src-img="srcPreviewImg" :preview-img="handlePreviewImg"
                :update-img-value="form" />

            <Select v-model="form.category_id" :selectedValue="form.category_id" label="Category" name="category_id"
                :datas="categories.data" />
            <MultipleSelect v-model="form.tags" :selectedValue="form.tags" label="Tags :" name="tags" :datas="tags.data" />
            <div class="flex flex-col mb-4">
                <label for="content">Content :</label>
                <textarea v-model="form.content" name="content" id="content" cols="30" rows="10"></textarea>
            </div>
            <ButtonForm>Create</ButtonForm>
        </form>
    </DashboardLayout>
</template>