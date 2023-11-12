<script setup>
import Comments from '@/Components/Comments.vue';
import Tag from '@/Components/Tag.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
// import CardRelatePost from '@/Components/CardRelatePost.vue';
import { Link } from '@inertiajs/vue3';

defineProps([
    'post',
    'comment',
    'relatedPosts'
])

</script>

<template>
    <AppLayout>
        <!-- image start -->
        <div class="relative flex justify-center">
            <div class="rounded-xl absolute -bottom-2.5 right-2 z-10">
                <Link
                    class="px-4 py-2 w-max bg-violet-600 text-violet-200 hover:text-violet-600 hover:bg-violet-200 rounded-full">
                {{ post.data.category.title }}</Link>
            </div>
            <img class="border rounded-lg w-full"
                src="https://www.travelandleisure.com/thmb/kfcKH88gBt_d1ZJPFg_rUcyMekU=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/TAL-grand-teton-USMNTNSIPOG0823-2538d183b9094e3fb59dd5e54bbe791c.jpg"
                alt="">
        </div>
        <!-- image end -->
        <div class="px-5">
            <!-- uploader start -->
            <div class="flex items-center gap-2 mt-3">
                <div class="rounded-full overflow-hidden h-9 w-9 border border-primary">
                    <img src="https://cdn-icons-png.flaticon.com/128/236/236831.png" alt="">
                </div>
                <div class="flex flex-col">
                    <h1 class="font-medium">{{ post.data.user }}</h1>
                    <span class="text-sm">{{ post.data.date }}</span>
                </div>
            </div>
            <!-- uploader end -->
            <h1 class="mt-5 font-bold text-2xl leading-normal">
                {{ post.data.title }}
            </h1>

            <div class="flex gap-2 flex-wrap mt-2 mb-10">
                <Tag v-for="tag in post.data.tags">{{ tag.title }}</Tag>
            </div>

            <!-- content start -->
            <div class="">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aspernatur quaerat omnis quia? Sint aspernatur
                repellendus saepe recusandae ut molestias, deserunt, voluptates impedit quibusdam maxime facilis asperiores
                obcaecati reprehenderit modi quisquam itaque possimus enim debitis adipisci nihil nesciunt. Eaque omnis,
                nobis,
                aspernatur beatae sequi aliquam laudantium ducimus itaque suscipit saepe repellat delectus placeat enim
                numquam,
                consequuntur est sint vitae. Consequatur, non ea perspiciatis est molestiae assumenda in suscipit quasi
                provident cumque itaque tempora unde minus nisi dicta quibusdam ad natus iure quod voluptatem incidunt. Qui,
                placeat. Ducimus iste eaque, quam debitis sunt dolorem doloribus reprehenderit consequatur et, libero earum
                in
                nostrum, quisquam architecto itaque? Ab beatae quia assumenda consequatur officia quos ea sed minima? Vero
                dolorem mollitia nesciunt in minus totam! Quidem eos molestiae dolore ut libero fuga qui animi? Obcaecati
                neque
                voluptatum id nisi provident aperiam. Unde iusto magnam, repellendus fugiat at, vel ea consequatur omnis,
                perspiciatis voluptatibus ad temporibus tenetur culpa quam natus aliquam obcaecati quas et! Eveniet
                consequuntur
                incidunt ad doloribus dolore possimus consequatur. Quos, voluptas inventore voluptates corrupti, odio
                consequatur officia quis quibusdam explicabo, quam non. Esse ipsa, officiis praesentium maiores neque
                suscipit
                vel, expedita nesciunt omnis quae repellat perspiciatis, tenetur nemo excepturi porro illum consectetur.
                Praesentium deserunt, adipisci nulla odio, at quis sapiente maiores incidunt omnis saepe asperiores?
                Voluptatem
                tempore vitae corporis quis, laboriosam rerum inventore illum pariatur deleniti commodi suscipit, facere
                voluptatibus? Fugiat officiis nulla vero laudantium animi voluptatum numquam ut reiciendis rerum incidunt
                iure
                sapiente consectetur ratione qui suscipit totam, laboriosam quia beatae voluptatibus mollitia facere aliquid
                non
                quam id. Cum placeat fugiat quaerat amet dolores nihil sit totam ad ipsam pariatur necessitatibus sunt iure
                nesciunt maxime nemo itaque eveniet quo quae, consequuntur magnam minus atque dignissimos. Modi maxime
                reiciendis, similique nam adipisci, quam dolorum asperiores praesentium iure veritatis labore itaque ad eum
                eveniet cupiditate aliquam assumenda fugiat ea maiores esse architecto ratione perspiciatis commodi.
                Maiores,
                cupiditate sapiente? Voluptate odio corporis, beatae eius totam perferendis maxime illo! Voluptate officiis
                id
                velit. Optio repudiandae odit obcaecati, vitae accusamus aliquam debitis at sit deleniti, impedit laboriosam
                eligendi ipsum ea quia quam dolores nesciunt saepe quaerat totam cupiditate. Corporis iste iusto dolorum
                nihil
                expedita suscipit, illum exercitationem pariatur maxime corrupti, quam saepe enim libero, tempora nulla
                mollitia
                sint! Accusamus quibusdam sapiente repellat, at, impedit quasi maxime error, voluptate fuga odio mollitia
                eos
                quaerat nihil. Ipsam in quod architecto, nihil esse dolorum eos? At similique, voluptatibus quam
                necessitatibus
                odio ducimus adipisci asperiores tenetur repellat libero quae natus voluptate dolorum quibusdam molestiae
                maiores impedit suscipit vitae minima optio quas dolorem voluptatem. Laboriosam vitae et quam alias
                doloribus
                nam a ducimus consectetur. Voluptatibus nam id saepe harum quaerat quidem earum dolorum est rem beatae omnis
                voluptatem, dolore odio eos veniam, qui ex architecto reiciendis natus distinctio! Eligendi aspernatur
                accusamus
                illum quod doloribus nulla maiores ea deserunt saepe, quidem perferendis hic veniam quibusdam, commodi nam
                sapiente blanditiis dignissimos praesentium similique culpa totam quis nostrum atque? Porro vel veritatis
                hic
                ipsam iste facere alias voluptas error? Iure commodi nostrum sed tempore aut.
            </div>
            <!-- content end -->

            <!-- related post start -->
            <div class="my-10">
                <h1 class="font-medium text-xl mb-4">Relate Post</h1>
                <div class="grid grid-cols-12 gap-5">

                    <Link v-for="relatedPost in relatedPosts.data" :href="route('home.post.show', relatedPost.slug)"
                        class="col-span-12 lg:col-span-6 grid grid-cols-12 gap-7">
                    <div class="col-span-5 mt-0 rounded-xl overflow-hidden border shadow-lg h-max">
                        <img class="hover:scale-110 transition"
                            src="https://assets-pergikuliner.com/uploads/bootsy/image/16254/medium_picture-1501940123.jpg"
                            alt="">
                    </div>
                    <div class="col-span-7 flex flex-col gap-2 justify-between">
                        <h1 class="font-semibold text-lg">
                            {{ relatedPost.title }}
                        </h1>
                    </div>
                    </Link>

                </div>
            </div>
            <!-- related post end -->

            <div class="">
                <Link :href="route('posts.comments.index', post.data.slug)">Comments : {{ post.data.comments.length }}
                </Link>

                <Comments :post="post" />
            </div>
        </div>
    </AppLayout>
</template>