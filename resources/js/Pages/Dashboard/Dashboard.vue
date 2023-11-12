<script setup>
import CardDashboard from '@/Components/CardDashboard.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps(['totalPosts', 'totalCategories', 'totalTags'])
</script>

<template>
    <DashboardLayout>
        <div class="">
            <h1 class="text-3xl font-extrabold mb-5">Dashboard</h1>
            <!-- profile start -->
            <div class="w-3/4 lg:w-1/3 bg-white flex justify-between mb-4 border p-3 rounded-xl">
                <div class="flex gap-1 items-center">
                    <img class="w-10 h-10 rounded-full" src="https://cdn-icons-png.flaticon.com/128/236/236831.png" alt="">
                    <div class="flex flex-col">
                        <h1 class="font-bold">Admin</h1>
                        <h1>{{ $page.props.auth.user.name }}</h1>
                    </div>
                </div>
                <Link method="POST" :href="route('logout')"
                    class="px-2.5 py-1 text-base font-bold rounded-xl bg-red-500 text-white flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                </svg>
                <h1>Log Out</h1>
                </Link>
            </div>
            <!-- profile end -->

            <div class="grid grid-cols-12 gap-3">
                <CardDashboard :total="totalPosts">Admin</CardDashboard>
                <CardDashboard :total="totalPosts">People</CardDashboard>
                <CardDashboard :total="totalPosts">Total Posts</CardDashboard>
                <CardDashboard :total="totalCategories">Total Categories</CardDashboard>
                <CardDashboard :total="totalTags">Total Tags</CardDashboard>
            </div>
        </div>
    </DashboardLayout>
</template>