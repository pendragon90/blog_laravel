<script setup>
import Pagination from '@/Components/Pagination.vue'
import Perpage from '@/Components/Perpage.vue'
import SelectFilter from '@/Components/SelectFilter.vue'
import { Link, router } from '@inertiajs/vue3';
import { ref, watchEffect, watch } from 'vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import Swal from 'sweetalert2';
import Tag from '@/Components/Tag.vue';
import Search from '@/Components/Search.vue';

const props = defineProps({
    flash: String,
    totalPosts: Number,
    posts: Object,
    categories: Object,
    tags: Object
});

const search = ref('')
const perpage = ref(10)
const category = ref('All')
const tag = ref('All')

watchEffect(() => {
    if (props.flash.success) {
        Swal.fire({
            title: props.flash.success,
            icon: 'success',
            timer: 1500,
            showConfirmButton: false
        })
    } else if (props.flash.updated) {
        Swal.fire({
            title: props.flash.updated,
            icon: 'success',
            timer: 1500,
            showConfirmButton: false
        })
    }
})

const deletePost = (post) => {
    Swal.fire({
        title: `Are you sure delete? ${post.title}`,
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            router.post(route('posts.destroy', post), {
                _method: "DELETE"
            })
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
        }
    })
}

watch(search, (val) => {
    router.get('/dashboard/posts', { search: val }, {
        preserveState: true,
        replace: true
    })
})

watch(category, (val) => {
    router.get('/dashboard/posts', { category: val.title }, {
        preserveState: true,
        replace: true
    })
})

watch(tag, (val) => {
    router.get('/dashboard/posts', { tag: val.title }, {
        preserveState: true,
        replace: true
    })
})

watch(perpage, (val) => {
    router.get('/dashboard/posts', { perpage: val }, {
        preserveState: true,
        replace: true
    })
})

</script>

<template>
    <DashboardLayout>
        <div class="flex justify-between">
            <h1 class="text-3xl font-bold">Posts</h1>
            <Link :href="route('posts.create')"
                class="cursor-pointer text-white bg-theme hover:bg-blue-600 w-max text-base px-4 py-1.5 rounded-lg border flex items-center">
            New Post
            </Link>
        </div>

        <!-- filter desktop start -->
        <div class="hidden lg:flex items-end justify-between my-5">
            <h1 class="text-slate-500 text-lg">Total Posts : <span class="text-primary">{{ props.totalPosts }}</span></h1>
            <div class="flex items-end gap-3 mx-5">
                <Search v-model="search" placeholder="Search Post..." />
                <Perpage label="Perpage" v-model="perpage" :value="perpage" />
                <SelectFilter label="Filter by Category" v-model="category" :value="category"
                    :datas="props.categories.data" />
                <SelectFilter label="Filter by Tags" v-model="tag" :value="tag" :datas="props.tags.data" />
            </div>
        </div>
        <!-- filter desktop end -->

        <!-- filter mobile start -->
        <div class="lg:hidden block">
            <h1 class="text-slate-500 text-lg my-5">Total Posts : <span class="text-primary">{{ props.totalPosts }}</span>
            </h1>
            <Search v-model="search" placeholder="Search Post..." />
            <div class="flex gap-3 items-end my-3">
                <Perpage label="Perpage" v-model="perpage" :value="perpage" />
                <SelectFilter label="Filter by Category" v-model="category" :value="category"
                    :datas="props.categories.data" />
                <SelectFilter label="Filter by Tags" v-model="tag" :value="tag" :datas="props.tags.data" />
            </div>
        </div>
        <!-- filter mobile end -->

        <!-- table start -->
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-100 text-base text-primary">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Title
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tags
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Image
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="post in props.posts.data" class="text-sm">
                        <td scope="row" class="px-6 py-4 align-text-top">
                            {{ post.title }}
                        </td>
                        <td scope="row" class="px-6 py-4 align-text-top">
                            {{ post.category.title }}
                        </td>
                        <td scope="row" class="px-6 py-4 flex flex-wrap gap-2">
                            <Tag v-for="tag in post.tags">
                                {{ tag.title }}
                            </Tag>
                        </td>
                        <td scope="row" class="px-6 py-4">
                            <img class="w-40 border border-theme" :class="{ 'hidden': post.img == null }" :src="post.img">
                        </td>
                        <td scope="row" class="px-6 py-4 flex gap-2">
                            <Link :href="route('posts.edit', post)" class="px-3 py-1.5 rounded-lg bg-yellow-500 text-white">
                            Edit</Link>
                            <div @click="deletePost(post)"
                                class="cursor-pointer px-3 py-1.5 rounded-lg bg-red-500 text-white">
                                Delete</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- table end -->

        <div class="flex justify-center">
            <div class='flex gap-3 items-center justify-center'>
                <div class="justify-center items-center gap-3">
                    <Pagination :meta="props.posts.meta.links" :current_page="props.posts.meta.current_page" />
                </div>
            </div>
        </div>
    </DashboardLayout></template>