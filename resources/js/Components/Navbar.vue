<script setup>
import { Link, router, usePage } from '@inertiajs/vue3';
import Input from '@/Components/Input.vue'
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
import { computed } from 'vue';
import { watch } from 'vue';
import { ref } from 'vue';
import Tag from './Tag.vue';
import Search from './Search.vue';
import Button from './Button.vue';

const props = defineProps({
    postsNavbar: Object,
    latestPosts: Object
})

const page = usePage()
const search = ref('')
const isOpenMenu = ref(false)
const isOpenSearch = ref(false)
const isOpenSearchDesktop = ref(false)

const latestPosts = computed(() => page.props.latestPosts)
const postsNavbar = computed(() => page.props.postsNavbar)

watch(search, (val) => {
    router.get('/', { search: val }, {
        preserveState: true,
        replace: true
    })
})

</script>

<template>
    <nav class="fixed left-0 right-0 bg-white z-20 shadow">
        <div class="px-7 py-2">
            <div class="flex items-center justify-between">
                <div class="flex gap-3 items-center">
                    <!-- menu bar start -->
                    <svg @click="isOpenMenu = !isOpenMenu" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="lg:hidden block w-6 h-6 cursor-pointer">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!-- menu bar end -->
                    <Link href="/" class="text-primary font-bold text-2xl pl-5">
                    GeekVerse
                    </Link>
                </div>
                <div class="hidden lg:flex gap-10 justify-between">
                    <Link href="/"
                        class="font-medium text-primary text-lg hover:text-theme hover:border-b-2 hover:border-b-theme py-0.5">
                    Home
                    </Link>
                    <Link href="/tags"
                        class="font-medium text-primary text-lg hover:text-theme hover:border-b-2 hover:border-b-theme py-0.5">
                    Tags
                    </Link>
                    <Link :href="route('about')"
                        class="font-medium text-primary text-lg hover:text-theme hover:border-b-2 hover:border-b-theme py-0.5">
                    About
                    </Link>
                </div>

                <div class="flex gap-3 items-center">
                    <!-- search desktop start -->
                    <div class="relative hidden lg:block">
                        <Search @click="isOpenSearchDesktop = !isOpenSearchDesktop" v-model="search"
                            placeholder="Search Post..." />
                        <div v-show="isOpenSearchDesktop"
                            class="flex flex-col gap-3 mt-5 bg-white absolute z-10 border shadow-lg p-3 rounded-lg -left-10 overflow-y-scroll">
                            <div v-for="post in postsNavbar.data" class="border-b border-b-slate-300 py-2">
                                <Link v-if="post" :href="route('home.post.show', post.slug)">{{ post.title
                                }}
                                </Link>
                            </div>
                        </div>
                    </div>
                    <!-- search desktop end -->

                    <!-- profile menu start -->
                    <Menu v-if="$page.props.auth.user" as="div" class="relative z-20">
                        <MenuButton class="flex gap-3 items-center">
                            <img class="rounded-full overflow-hidden h-9 w-9 border border-primary"
                                :src="$page.props.auth.img ? $page.props.auth.img : 'https://www.its.ac.id/it/wp-content/uploads/sites/46/2021/06/blank-profile-picture-973460_1280.png'"
                                alt="">
                            <h1 class="font-medium">{{ $page.props.auth.user.name }}</h1>
                        </MenuButton>
                        <MenuItems class="flex flex-col gap-3 w-max bg-white p-3 border rounded-lg absolute -left-20">
                            <MenuItem>
                            <Link class="hover:text-theme" :href="route('profile.edit')">
                            Profile
                            </Link>
                            </MenuItem>
                            <MenuItem>
                            <Link class="hover:text-theme" href="/dashboard">
                            Dashboard
                            </Link>
                            </MenuItem>
                            <MenuItem>
                            <Link method="POST" :href="route('logout')"
                                class="px-3 py-1.5 w-full rounded-lg bg-red-500 hover:bg-red-600 text-white flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                            </svg>
                            <h1>Log Out</h1>
                            </Link>
                            </MenuItem>
                        </MenuItems>
                    </Menu>
                    <!-- profile menu end -->
                    <div class="flex gap-3" v-else>
                        <Button :href="route('login')">Login</Button>
                        <Button :href="route('register')">Register</Button>
                    </div>

                </div>
            </div>

        </div>

        <!-- sidebar desktop start -->
        <div class="hidden lg:block bg-white w-1/4 h-screen absolute px-3 py-1.5 right-0 border overflow-y-scroll">
            <div class="px-5 py-5">
                <h1 class="font-bold text-xl text-primary mb-3">Latest Posts</h1>

                <div class="flex flex-col gap-5 mb-16">
                    <Link class="py-1 border-b" v-for="post in latestPosts" :href="route('home.post.show', post.slug)">{{
                        post.title }}</Link>
                </div>
            </div>
        </div>
        <!-- sidebar desktop end -->

        <!-- sidebar mobile start -->
        <div v-show="isOpenMenu" class="lg:hidden block bg-white w-1/2 h-screen absolute px-3 py-1.5">
            <div class="flex flex-col items-start px-5 py-5 text-lg gap-3 font-medium">
                <Link href="/"
                    class="px-3 py-1.5 w-full rounded-lg flex gap-2 items-center hover:bg-slate-100 hover:text-theme">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                <h1>Home</h1>
                </Link>
                <Link href="/tags"
                    class="px-3 py-1.5 w-full rounded-lg flex gap-2 items-center hover:bg-slate-100 hover:text-theme">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                <h1>Tags</h1>
                </Link>
                <Link :href="route('about')"
                    class="px-3 py-1.5 w-full rounded-lg flex gap-2 items-center hover:bg-slate-100 hover:text-theme">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                <h1>About</h1>
                </Link>
            </div>
        </div>
        <!-- sidebar mobile end -->
    </nav>

    <!-- search layout start -->
    <div v-show="isOpenSearch" class="h-screen right-0 left-0 fixed z-50 backdrop-blur flex justify-center items-start">
        <div class="bg-white flex flex-col rounded-lg p-3 border shadow-lg my-10 mx-5">
            <h1 class="text-end mb-3" @click="isOpenSearch = false">Close</h1>
            <Search v-model="search" placeholder="Search Post..." />
            <div class="flex flex-col gap-3 mt-5">
                <Link :href="route('home.post.show', post.slug)" v-for="post in postsNavbar.data">{{ post.title }}</Link>
            </div>
        </div>
    </div>
    <!-- search layout end -->
</template>