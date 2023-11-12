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
    postSingle: Object,
    categories: Object,
    tags: Object
})

const srcPreviewImg = ref(null)

const form = useForm({
    title: props.postSingle.data.title,
    img: props.postSingle.data.img,
    category_id: props.postSingle.data.category,
    tags: props.postSingle.data.tags,
    content: props.postSingle.data.content
})

const submit = () => {
    form.transform(data => ({
        _method: "PUT",
        ...data,
        category_id: form.category_id.id,
        tags: form.tags.map(tag => tag.id)
    })).post(route('posts.update', props.postSingle.data))
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
        <div class="mx-auto py-20 max-w-2xl">
            <form @submit.prevent="submit">
                <Input v-model="form.title" :value="form.title" label="Title :" name="title" type="text" />
                <span v-if="form.errors.title" class="text-red-600">{{ form.errors.title }}</span>
                <input type="hidden" name="oldImg" :value="props.postSingle.data.img">

                <InputFile label="Image :" name="img" type="file" :old-img="form.img" :src-img="srcPreviewImg"
                    :preview-img="handlePreviewImg" :update-img-value="form" />
                <Select v-model="form.category_id" :selectedValue="form.category_id" label="Category" name="category_id"
                    :datas="categories.data" />
                <MultipleSelect v-model="form.tags" :selectedValue="form.tags" label="Tags :" name="tags"
                    :datas="tags.data" />
                <div class="flex flex-col mb-4">
                    <label for="content">Content :</label>
                    <textarea v-model="form.content" name="content" id="content" cols="30" rows="10" />
                    <span v-if="form.errors.content" class="text-red-600">{{ form.errors.content }}</span>
                </div>
                <ButtonForm>Create</ButtonForm>
            </form>
        </div>
    </DashboardLayout>
</template>