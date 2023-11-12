<template>
    <AppLayout>
        <div class="w-3/4 border rounded-lg mx-auto p-10">
            <h1 class="font-bold text-2xl mb-5">Edit Comment</h1>
            <div class="flex gap-3">
                <div class="rounded-full w-10 h-9 overflow-hidden border border-primary">
                    <img src="https://i.pinimg.com/236x/77/f9/86/77f9867fbe1f892c908352e335af5851.jpg" alt="">
                </div>
                <form @submit.prevent="handleEdit" class="w-full bg-white">
                    <div class="flex flex-col gap-3 border border-slate-400 rounded-xl p-3 mb-5">
                        <div class="flex items-center justify-between">
                            <h1 type="text" class="text-slate-600 font-medium border-none">{{ props.comment.data.user }}
                            </h1>
                            <h1>{{ comment.data.date }}</h1>
                        </div>
                        <input type="text" class="border-none focus:rounded-lg focus:ring-0" v-model="form.content_comment">
                    </div>
                    <ButtonForm>Save</ButtonForm>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import ButtonForm from '@/Components/ButtonForm.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps(['post', 'comment'])

const form = useForm({
    content_comment: props.comment.data.content_comment
})

const handleEdit = () => {
    form.transform((data) => ({
        _method: "PUT",
        ...data
    })).post(route('posts.comments.update', [props.post.data.slug, props.comment.data.slug]))
    form.reset()
}

</script>