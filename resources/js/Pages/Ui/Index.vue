<template>
    <Layout>

        <div class="">
            <nav class="navbar navbar-expand-lg fixed-top" style="margin: 0 12px 0 12px; ">
                <div class="container px-2">
                    <Link class="navbar-brand" href="/" data-aos="fade-right" data-aos-duration="2000">Hornbill
                    Blog</Link>
                    <button class="navbar-toggler " type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0" data-aos="fade-left" data-aos-duration="2000">

                            <template v-if="authUser == null">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#signIn"
                                        data-bs-toggle="offcanvas" aria-controls="staticBackdrop">Sign In</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#signUp" data-bs-toggle="offcanvas"
                                        aria-controls="staticBackdrop">Sign
                                        Up</a>
                                </li>
                            </template>
                            <template v-else>
                                <li class="nav-item">
                                    <a class="nav-link">{{ authUser.name }}</a>
                                </li>
                                <li class="nav-item">
                                    <Link onclick="confirm('Are you sure you want to Logout?')" class="nav-link"
                                        href="/logout">Sign
                                    Out</Link>
                                </li>
                            </template>

                        </ul>
                    </div>
                </div>

            </nav>
            <div class="">
                <header class="pt-5">
                    <div class="container">
                        <div class="row d-flex align-items-center justify-content-center">
                            <div class="col-md-6 text-center">
                                <img src="/assets/images/header.jpg" class="img-fluid rounded" alt="" data-aos="zoom-in"
                                    data-aos-duration="2000">
                            </div>
                            <div class="col-md-6 py-5 text-center" data-aos="zoom-in" data-aos-duration="2000">
                                <h1>Today a reader, tomorrow a leader :)</h1>
                                <h5>Focus on your dream & fight for it, then become the king</h5>
                            </div>
                        </div>
                    </div>
                </header>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                    <path fill="#6366f1" fill-opacity="1"
                        d="M0,128L60,138.7C120,149,240,171,360,165.3C480,160,600,128,720,138.7C840,149,960,203,1080,208C1200,213,1320,171,1380,149.3L1440,128L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z">
                    </path>
                </svg>
            </div>
        </div>

        <div id="blog">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h3 data-aos="fade-right" data-aos-duration="2000">Read Our Blogs</h3>
                        <div class="heading-line" data-aos="fade-left" data-aos-duration="2000"></div>
                        <div v-if="props.post != 0">
                            <div class="card my-3" data-aos="zoom-in" data-aos-duration="2000"
                                v-for="post in props.post">
                                <div class="card-body p-0">
                                    <div class="img-wrapper">
                                        <img :src="`/storage/post/${post.image}`" class="image-fluid "
                                            style="width: 100%;" alt="">
                                    </div>
                                    <div class="content p-3">
                                        <h5>{{ post.title }}.</h5>
                                        <div class="my-2 heading-line" data-aos="fade-left" data-aos-duration="2000">
                                        </div>
                                        <div class="mb-3">
                                            {{ formatDate(new Date(post.created_at)) }}
                                        </div>
                                        <p>
                                            {{ subString(post.content, 150) }}
                                            <Link :preserve-scroll="true" :href="`/post/${post.id}/details`"
                                                class="text-decoration-none">See More
                                            </Link>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="" v-else>
                            <div class="card card-body">
                                <p class="text-center my-3">
                                    Don't have any post related to this category!
                                </p>
                                <Link :preserve-scroll="true" class="btn btn-primary btn-sm " href="/">Back To All Posts
                                </Link>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-4">
                        <h5 data-aos="fade-left" data-aos-duration="2000">Blogs Categories</h5>
                        <div class="heading-line" data-aos="fade-right" data-aos-duration="2000"></div>
                        <ul class="mb-5" data-aos="zoom-in" data-aos-duration="2000">
                            <li>
                                <Link href="/">All Posts</Link>
                            </li>
                            <li class="my-2" v-for="category in props.category">
                                <Link :preserve-scroll="true" :href="`/searchByCategory/${category.id}`">{{
                                category.name }}
                                </Link>
                            </li>
                        </ul>
                        <h5 data-aos="fade-left" data-aos-duration="2000">Blogs You May Like</h5>
                        <div class="heading-line" data-aos="fade-right" data-aos-duration="2000"></div>
                        <Link :preserve-scroll="true" :href="`/post/${post.id}/details`"
                            v-for="post in props.postUMayLike">
                        <div class="recent-blog border rounded p-2 my-1 d-flex justify-content-between align-items-center"
                            data-aos="zoom-in" data-aos-duration="2000">
                            <img :src="`/storage/post/${post.image}`" style="width: 130px;" alt="">
                            <div class="ms-2">
                                {{ subString(post.content, 80) }}
                            </div>
                        </div>
                        </Link>

                    </div>
                </div>
            </div>
        </div>

        <div class="">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" id="footer-wave">
                <path fill="#6366f1" fill-opacity="1"
                    d="M0,32L48,37.3C96,43,192,53,288,90.7C384,128,480,192,576,192C672,192,768,128,864,117.3C960,107,1056,149,1152,149.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
            </svg>
            <footer id="footer" class="d-flex justify-content-center align-items-center">
                <div class="container">
                    <div> &copy; 2023 Hornbill Technology, Inc. All rights reserved.
                    </div>
                </div>
            </footer>
        </div>

        <!-- sign up  -->

        <Login></Login>
        <!-- sign in  -->
        <Register></Register>
    </Layout>

    <!-- 
    <link rel="stylesheet" href="/assets/aos/aos.css">
    <link rel="stylesheet" href="/assets/aos/aos.js"> -->
</template>

<script setup>
import Layout from './Layout.vue';
import Register from './../Auth/Login.vue';
import Login from './../Auth/Register.vue'
import moment from 'moment';

import { computed } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'

const props = defineProps({
    'post': Object,
    'category': Object,
    'postUMayLike': Object,
})

const page = usePage()

const authUser = computed(() => page.props.auth.user)


const formatDate = (date) => {
    return moment(date).fromNow();
};
// const formatDate = (date) => {
// Format the date as desired (e.g., 'YYYY-MM-DD HH:MM:SS')
// return `${date.toLocaleDateString()} ${date.toLocaleTimeString([], { hour: 'numeric', minute: '2-digit', hour12: true })}`;
// }

const subString = (string, num) => {
    if (string.length > num) {
        return string.substring(0, num) + '...'
    }
    return string
}


</script>

<style lang="scss" scoped></style>