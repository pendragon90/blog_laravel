<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import InputFile from '@/Components/InputFile.vue';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const srcPreviewImg = ref(null)

const form = useForm({
    img: null
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
    <AppLayout>
        <div class="py-20">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <InputFile label="Profile Image :" name="img" type="file" :src-img="srcPreviewImg"
                    :preview-img="handlePreviewImg" :update-img-value="form" />
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdateProfileInformationForm :must-verify-email="mustVerifyEmail" :status="status" class="max-w-xl" />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
