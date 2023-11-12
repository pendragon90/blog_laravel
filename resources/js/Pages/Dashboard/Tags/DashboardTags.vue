<script setup>
import Pagination from '@/Components/Pagination.vue'
import { Link, router } from '@inertiajs/vue3';
import { ref, watchEffect, watch } from 'vue';
import Input from '@/Components/Input.vue'
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import Swal from 'sweetalert2';
import Perpage from '@/Components/Perpage.vue';
import Search from '@/Components/Search.vue';

const props = defineProps({
    flash: String,
    totalTags: Number,
    tags: Object
});

const search = ref('')
const perpage = ref(10)

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

const deleteTag = (tag) => {
    Swal.fire({
        title: `Are you sure delete? ${tag.title}`,
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            router.post(route('tags.destroy', tag), {
                _method: "DELETE"
            })
            Swal.fire(
                'Deleted!',
                'Your data has been deleted.',
                'success'
            )
        }
    })
}

watch(search, (val) => {
    router.get('/dashboard/tags', { search: val }, {
        preserveState: true,
        replace: true
    })
})

watch(perpage, (val) => {
    router.get('/dashboard/tags', { perpage: val }, {
        preserveState: true,
        replace: true
    })
})

</script>

<template>
    <DashboardLayout>
        <div class="flex justify-between">
            <h1 class="text-3xl font-bold">Tag Post</h1>
            <Link :href="route('tags.create')"
                class="cursor-pointer text-white bg-theme hover:bg-blue-600 w-max text-base px-4 py-1.5 rounded-lg border flex items-center">
            New Tag
            </Link>
        </div>

        <!-- filter desktop start -->
        <div class="hidden lg:flex items-end justify-between my-5">
            <h1 class="text-slate-500 text-lg">Total Categories : <span class="text-primary">{{ props.totalTags
            }}</span></h1>
            <div class="flex items-end gap-3 mx-5">
                <Search v-model="search" placeholder="Search Category..." />
                <Perpage label="Perpage" v-model="perpage" :value="perpage" />
            </div>
        </div>
        <!-- filter desktop end -->

        <!-- filter mobile start -->
        <div class="lg:hidden block">
            <h1 class="text-slate-500 text-lg mt-5">Total Categories : <span class="text-primary">{{ props.totalTags
            }}</span></h1>
            <div class="flex items-end gap-3 my-3">
                <Search v-model="search" placeholder="Search Category..." />
                <Perpage label="Perpage" v-model="perpage" :value="perpage" />
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
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="tag in props.tags.data" class="text-sm">
                        <td scope="row" class="px-6 py-4 align-text-top">
                            {{ tag.title }}
                        </td>
                        <td scope="row" class="px-6 py-4 flex gap-2">
                            <Link :href="route('tags.edit', tag)" class="px-3 py-1.5 rounded-lg bg-yellow-500 text-white">
                            Edit</Link>
                            <div @click="deleteTag(tag)"
                                class="cursor-pointer px-3 py-1.5 rounded-lg bg-red-500 text-white">
                                Delete</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- table end -->

        <div class="flex justify-center my-5">
            <div class='flex gap-3 items-center justify-center'>
                <div class="justify-center items-center gap-3">
                    <Pagination :meta="props.tags.meta.links" :current_page="props.tags.meta.current_page" />
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>