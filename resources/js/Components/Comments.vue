<template>
    <div class="h-screen w-full flex flex-col gap-7">

        <!-- create comment start -->
        <div class="flex gap-3">
            <div class="rounded-full w-10 h-9 overflow-hidden border border-primary">
                <img src='https://www.its.ac.id/it/wp-content/uploads/sites/46/2021/06/blank-profile-picture-973460_1280.png'
                    alt="">
            </div>
            <form @submit.prevent="submitCreateComment" class="flex flex-col gap-2 w-full">
                <Input v-model="formComment.content_comment" type="text" class="mb-2" />
                <ButtonForm class="hover:bg-green-600">Create Comment</ButtonForm>
            </form>
        </div>
        <!-- create comment end -->

        <div class="flex flex-col gap-3" v-for="comment in props.post.data.comments">
            <!-- comment start -->
            <div class="flex gap-3">
                <div class="rounded-full w-10 h-9 overflow-hidden border border-primary">
                    <img src='https://www.its.ac.id/it/wp-content/uploads/sites/46/2021/06/blank-profile-picture-973460_1280.png'
                        alt="">
                </div>
                <div class="w-full border border-slate-400 rounded-xl p-3 bg-white flex flex-col gap-3">
                    <div class="flex justify-between">
                        <h1 class="text-slate-600 font-medium">{{ comment.user }}</h1>
                        <!-- actions start -->
                        <Menu v-if="comment.user == $page.props.auth.user.name" as="div" class="relative">
                            <MenuButton>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                </svg>
                            </MenuButton>
                            <MenuItems
                                class="absolute -left-20 -bottom-24 border border-slate-400 bg-white rounded-lg p-3 flex flex-col gap-2">
                                <MenuItem>
                                <Link :href="route('posts.comments.edit', [props.post.data.slug, comment.slug])"
                                    class="px-3 py-1.5 bg-yellow-500 hover:bg-yellow-600 text-white text-center rounded-lg">
                                Edit</Link>
                                </MenuItem>
                                <MenuItem>
                                <button @click="deleteComment(comment)"
                                    class="px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-center rounded-lg">Delete
                                </button>
                                </MenuItem>
                            </MenuItems>
                        </Menu>
                        <!-- actions end -->
                    </div>
                    <p>{{ comment.content }}</p>
                    <div class="flex justify-between items-end text-sm">
                        <div class="flex gap-2 items-center">
                            <button @click="toggleReply(comment)" class="flex gap-1 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                                </svg>
                                <h1 class="text-slate-500">{{ comment.replies.length }}</h1>
                            </button>
                            <button @click="toggleCreateReply(comment)"
                                class="px-3 py-1.5 bg-blue-500 hover:bg-blue-600 text-white text-center rounded-lg">Reply</button>
                        </div>
                        <h1 class="text-slate-500">{{ comment.date }}</h1>
                    </div>
                </div>
            </div>
            <!-- comment end -->

            <!-- create reply start -->
            <div v-show="comment.isOpenCreateReply" class="flex gap-3">
                <div class="rounded-full w-10 h-9 overflow-hidden border border-primary">
                    <img src='https://www.its.ac.id/it/wp-content/uploads/sites/46/2021/06/blank-profile-picture-973460_1280.png'
                        alt="">
                </div>
                <form @submit.prevent="submitCreateReply(comment)" class="flex flex-col gap-2 w-full">
                    <Input v-model="formReply.content_reply" type="text" class="mb-2" />
                    <ButtonForm class="hover:bg-green-600">Reply</ButtonForm>
                </form>
            </div>
            <!-- create reply end -->

            <div v-show="comment.isOpenReply" v-for="reply in comment.replies" class="flex flex-col gap-1 ml-20">
                <!-- reply start -->
                <div class="flex gap-3">
                    <div class="rounded-full w-10 h-9 overflow-hidden border border-primary">
                        <img src='https://www.its.ac.id/it/wp-content/uploads/sites/46/2021/06/blank-profile-picture-973460_1280.png'
                            alt="">
                    </div>
                    <div class="w-full border border-slate-400 rounded-xl p-3 bg-white flex flex-col gap-3">
                        <div class="flex justify-between">
                            <h1 class="text-slate-600 font-medium">{{ reply.user }}</h1>
                            <!-- actions start -->
                            <Menu v-if="reply.user == $page.props.auth.user.name" as="div" class="relative">
                                <MenuButton>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                    </svg>
                                </MenuButton>
                                <MenuItems
                                    class="absolute -left-20 -bottom-24 border border-slate-400 bg-white rounded-lg p-3 flex flex-col gap-2">
                                    <MenuItem>
                                    <Link
                                        :href="route('posts.comments.replies.edit', [props.post.data.slug, comment.slug, reply.slug])"
                                        class="px-3 py-1.5 bg-yellow-500 hover:bg-yellow-600 text-white text-center rounded-lg">
                                    Edit</Link>
                                    </MenuItem>
                                    <MenuItem>
                                    <button @click="deleteReply(comment.slug, reply.slug)"
                                        class="px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-center rounded-lg">Delete
                                    </button>
                                    </MenuItem>
                                </MenuItems>
                            </Menu>
                            <!-- actions end -->
                        </div>
                        <p>{{ reply.content }}</p>
                        <div class="flex justify-end text-sm">
                            <h1 class="text-slate-500">{{ reply.date }}</h1>
                        </div>
                    </div>
                </div>
                <!-- reply end -->
            </div>
        </div>
    </div>
</template>
  
<script setup>
import Input from '@/Components/Input.vue';
import { Link, router, useForm, usePage } from '@inertiajs/vue3';
import ButtonForm from './ButtonForm.vue';
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
import { computed } from 'vue';

const props = defineProps([
    'post',
    'comment'
])

const formComment = useForm({
    content_comment: ''
})
const formReply = useForm({
    content_reply: ''
})

// comments
const submitCreateComment = () => {
    formComment.transform((data) => ({
        ...data
    })).post(route('posts.comments.store', props.post.data))
    formComment.reset()
}

const deleteComment = (comment) => {
    router.post(route('posts.comments.destroy', [props.post.data, comment]), {
        _method: "DELETE"
    })
}

// replies
const submitCreateReply = (comment) => {
    formReply.transform((data) => ({
        ...data
    })).post(route('posts.comments.replies.store', [props.post.data, comment]))
    formReply.reset()
}

const deleteReply = (comment, reply) => {
    router.post(route('posts.comments.replies.destroy', [props.post.data.slug, comment, reply]), {
        _method: "DELETE"
    })
}

const toggleReply = (comment) => {
    comment.isOpenReply = !comment.isOpenReply;
}

const toggleCreateReply = (comment) => {
    comment.isOpenCreateReply = !comment.isOpenCreateReply
}
</script>
  