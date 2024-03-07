<template>
    <Layout>
        <div class="row">
            <div class="col-md-4 overflow-auto col-sm-4 p-0">
                <div class="border">
                    <div class="img-wrapper border">
                        <img :src="`/storage/post/${props.post.image}`" class="image-fluid " style="width: 100%;" alt="">
                    </div>

                    <div class="d-flex justify-content-between">
                        <span class=" mt-2 ms-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#likeBtn"
                            aria-controls="offcanvasBottom">
                            {{ props.likeCount }}
                            <span v-if="props.likeCount == 0">like</span>
                            <span v-else>likes</span>
                        </span>
                        <span class=" my-2 me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#commentBtn"
                            aria-controls="offcanvasBottom">
                            {{ props.commentCount }}
                            <span v-if="props.commentCount == 0">comment</span>
                            <span v-else>comments</span>
                        </span>
                    </div>
                </div>
                <div>
                    <Link href="/admin/posts" class="btn btn-primary btn-sm mt-2"> go back</Link>
                </div>
            </div>

            <div class=" col-md-8 col-sm-8">
                <div class="text-center ">
                    <h4 class="mx-4">{{ props.post.title }}</h4>
                    <p class="mx-5">{{ props.post.content }}</p>
                </div>

            </div>
        </div>

        <div class=" container offcanvas offcanvas-bottom rounded-top-2 long-offcanvas" style="top: auto;height: 95vh;"
            tabindex="-1" id="commentBtn" aria-labelledby="offcanvasBottomLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasBottomLabel">Comments
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="border"></div>
            <div class="offcanvas-body comment-section small">
                <div class="comment-container mb-0 p-3">
                    <div class="comment">
                        <template v-if="props.comment">
                            <div class="" v-if="props.commentCount != 0">
                                <div v-for="(comment ) in  props.comment " :key="comment.id" class="">
                                    <div v-if="comment.post_id == post.id" class=" clearfix p-2 rounded-3 my-1"
                                        data-aos="fade-right" data-aos-duration="2000">
                                        <div class="">
                                            <div class="clearfix d-flex flex-row">
                                                <div class="mt-1">

                                                    <span class=" border border-primary rounded-5 mx-3 py-2 px-3 "
                                                        :class="changeColor(comment.user.name)" style="font-size: 25px;">{{
                                                            subString(comment.user.name, 1) }}
                                                    </span>
                                                </div>
                                                <div class=" border border-primary px-2 py-1  mx-3 rounded-4">
                                                    <h5 class="m-0 ">
                                                        {{ comment.user.name }}
                                                    </h5>
                                                    <p class=" m-0 " style="font-size: 16px;">{{
                                                        comment.comment }}</p>
                                                </div>
                                            </div>
                                            <div class="ms-5">
                                                <span class="ms-5 px-1">
                                                    {{ formatDate(new
                                                        Date(comment.created_at)) }}
                                                </span>
                                            </div>


                                        </div>
                                    </div>
                                    <!-- </div> -->
                                </div>

                            </div>
                            <div class="card card-body mt-3" v-else>
                                <h5 class="py-2 d-flex justify-content-center">
                                    Don't have any comments for this post!
                                </h5>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

        </div>
        <div class=" container offcanvas offcanvas-bottom rounded-top-2 long-offcanvas" style="top: auto;height: 95vh;"
            tabindex="-1" id="likeBtn" aria-labelledby="offcanvasBottomLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasBottomLabel">Comments
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="border"></div>
            <div class="offcanvas-body comment-section small">
                <div class="comment-container mb-0 p-3">
                    <div class="comment">
                        <template v-if="props.like">
                            <div class="" v-if="props.likeCount != 0">
                                <div v-for="(like ) in  props.like " :key="like.id" class="">
                                    <div v-if="like.post_id == post.id" class=" clearfix p-2 rounded-3 my-1"
                                        data-aos="fade-right" data-aos-duration="2000">
                                        <div class="">
                                            <div class="clearfix d-flex flex-row">
                                                <div class=" float-end">
                                                    <span class=" border border-primary  rounded-5 mx-3 py-2 px-3 "
                                                        :class="changeColor(like.user.name)" style="font-size: 25px;">{{
                                                            subString(like.user.name, 1) }}
                                                    </span>
                                                </div>
                                                <div class="mx-2 py-1 rounded-4">
                                                    <h5> {{ like.user.name }}</h5>
                                                    <span class="px-1" style="font-size: 10px;">
                                                        {{ formatDate(new
                                                            Date(like.created_at)) }}
                                                    </span>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <!-- </div> -->
                                </div>

                            </div>
                            <div class="card card-body mt-3" v-else>
                                <h5 class="py-2 d-flex justify-content-center">
                                    Don't have like for this post!
                                </h5>
                            </div>
                        </template>



                    </div>
                </div>
            </div>

        </div>
    </Layout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Layout from '../Layout.vue';
import moment from 'moment';

const props = defineProps({
    'post': Object,
    'comment': Object,
    'commentCount': Number,
    'likeCount': Number,
    'like': Object,

})
const formatDate = (date) => {
    return moment(date).fromNow();
};

const subString = (string, num) => {
    if (string.length > num) {
        return string.substring(0, num).toUpperCase()
    }
    return string
}
const colors = () => {
    const colors = ['bg-primary', 'bg-secondary', 'bg-danger', 'bg-warning', 'bg-success', 'bg-info', 'bg-dark']
    const randomIndex = Math.floor(Math.random() * colors.length)
    return colors[randomIndex];

}
const colorMap = {}

const changeColor = (name) => {
    const userName = name.charAt(0).toUpperCase()


    if (userName >= 'A' && userName <= 'Z') {
        if (!colorMap[userName]) {
            colorMap[userName] = colors();

        }
        return colorMap[userName]

    } else {
        return 'bg-transparent'
    }
}

</script>

<style scoped></style>