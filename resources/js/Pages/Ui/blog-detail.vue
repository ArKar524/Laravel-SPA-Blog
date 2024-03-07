<template>
    <Layout>

        <div class="">
            <nav class="navbar navbar-expand-lg fixed-top" style="margin: 0 12px 0 12px;">
                <div class="container px-2">
                    <Link :preserve-scroll="true" class="navbar-brand" href="/" data-aos="fade-right"
                        data-aos-duration="2000">Hornbill
                    Blog</Link>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
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
                                    <Link :preserve-scroll="true" onclick="confirm('Are you sure you want to Logout?')"
                                        class="nav-link" href="/logout">Sign
                                    Out</Link>
                                </li>
                            </template>

                        </ul>
                    </div>
                </div>
            </nav>
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

        <div id="blog">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h3 data-aos="fade-right" data-aos-duration="2000">Blog Detail</h3>
                        <div class="heading-line" data-aos="fade-left" data-aos-duration="2000"></div>
                        <div class="card my-3" data-aos="zoom-in" data-aos-duration="2000">
                            <div class="card-body p-0">
                                <div class="img-wrapper">
                                    <img :src="`/storage/post/${post.image}`" class="img-fluid " alt="">
                                </div>
                                <div class="content p-3 clearfix">
                                    <h5>{{ post.title }}</h5>
                                    <div class="my-2 heading-line" data-aos="fade-left" data-aos-duration="2000"></div>
                                    <div class="mb-3">
                                        {{ formatDate(new Date(post.created_at)) }}
                                    </div>
                                    <p>
                                        {{ post.content }}
                                    </p>
                                    <div class="d-flex justify-content-between ">
                                        <span>{{ props.likes }}
                                            <span v-if="props.likes == 0 || props.like == 1"> like</span>
                                            <span v-else class="ms-0">likes</span>
                                        </span>
                                        <span>{{ props.commentsCount }} comments </span>
                                    </div>
                                    <div class="border my-1"></div>

                                    <div class="">
                                        <div class="container">
                                            <template v-if="authUser != null">
                                                <span class="">
                                                    <span class="" v-if="props.like === null">
                                                        <Link href="#" @click.prevent="likePost()"
                                                            class=" mx-2 pointer-events-none">
                                                        <i class="fa-regular fa-thumbs-up "
                                                            style="font-size: 25px;"></i>
                                                        </Link>
                                                    </span>
                                                    <span v-else>
                                                        <Link href="#" @click.prevent="likePost()" class=" mx-2 ">
                                                        <i class="fa-solid fa-thumbs-up " style="font-size: 25px;"></i>
                                                        </Link>
                                                    </span>

                                                </span>
                                            </template>

                                            <p class="float-end " type="button" data-bs-toggle="offcanvas"
                                                data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">
                                                Comments
                                            </p>

                                            <div class="offcanvas container offcanvas-bottom rounded-top-2 " style="top: auto;            
                                                    height: 80vh;
                                                    bottom: 153px;" tabindex="-1" id="offcanvasBottom"
                                                aria-labelledby="offcanvasBottomLabel">
                                                <div class="offcanvas-header ">
                                                    <h5 class="offcanvas-title" id="offcanvasBottomLabel">Comments
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="border"></div>
                                                <div class="offcanvas-body comment-section small">
                                                    <div class="comment-container mb-0 p-3">
                                                        <div class="comment  ">
                                                            <template v-if="props.comments">
                                                                <div class="" v-if="props.commentsCount != 0">
                                                                    <div v-for="(comment ) in  props.comments "
                                                                        :key="comment.id" class="">
                                                                        <div v-if="comment.post_id == post.id"
                                                                            class=" clearfix p-2 rounded-3 my-1"
                                                                            data-aos="fade-right"
                                                                            data-aos-duration="2000">
                                                                            <div class=""
                                                                                v-if="!editForm.editingComment || editForm.editingComment !== comment.id">
                                                                                <div class="clearfix d-flex flex-row">
                                                                                    <div class=" float-end">
                                                                                        <span
                                                                                            class=" border rounded-5 mx-3 py-2 px-3 "
                                                                                            :class="changeColor(comment.user.name)"
                                                                                            style="font-size: 25px;">{{
                        subStringUser(comment.user.name,
                            1)
                    }}
                                                                                        </span>
                                                                                    </div>
                                                                                    <div @mouseenter="editForm.hoveredComment = comment.id"
                                                                                        class="float border border-primary  mx-3 px-2 
                                                                                            py-0 rounded-3">
                                                                                        <h5 class="m-0"> {{
                        comment.user.name }}
                                                                                        </h5>
                                                                                        <p class="m-0"
                                                                                            style="font-size: 16px;">
                                                                                            {{
                        comment.comment }}</p>

                                                                                    </div>

                                                                                    <div class="mt-2">
                                                                                        <div
                                                                                            v-if="authUser ? (comment.user_id === authUser.id ? authUser.id : '') : ''">
                                                                                            <button as="button"
                                                                                                v-show="editForm.hoveredComment === comment.id"
                                                                                                @click="startEditing(comment.id)"
                                                                                                class="btn btn-primary btn-sm">
                                                                                                edit
                                                                                            </button>
                                                                                            <a @click.prevent="deleteComment(comment.id)"
                                                                                                as="button"
                                                                                                v-show="editForm.hoveredComment === comment.id"
                                                                                                onclick="confirm('Are you sure! You want to delete your comment?')"
                                                                                                class=" btn btn-danger bg-danger
                                                                                            btn-sm mx-2">
                                                                                                delete
                                                                                            </a>

                                                                                        </div>
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
                                                <div class="border border-2"></div>
                                                <div class="comment-input-container ">
                                                    <div class="overflow-hidden my-2" v-if="authUser">
                                                        <template v-if="editForm.editingComment !== null">
                                                            <div class="">
                                                                <textarea name="" id=""
                                                                    v-show="editForm.editingComment == hoverComment.hoverId"
                                                                    v-model="editForm.editedComment"
                                                                    class="form-control ms-3 mb-2 rounded-3"
                                                                    rows="3"></textarea>
                                                                <button
                                                                    class="btn btn-danger bg-danger me-5 btn-sm  float-end"
                                                                    @click="cancelEdit(hoverComment.hoverId)"
                                                                    onclick="confirm('Do you want to discard your editing')">Cancel</button>
                                                                <button class="btn btn-primary btn-sm mx-2 float-end"
                                                                    @click="saveEdit(hoverComment.hoverId)">Save</button>

                                                            </div>
                                                        </template>
                                                        <template v-else>
                                                            <form action="" data-aos="fade-left"
                                                                @submit.prevent="storeComment" data-aos-duration="2000"
                                                                class="mb-0">
                                                                <div class="">
                                                                    <div class="comment-textarea ">
                                                                        <div class="">
                                                                            <textarea v-model="form.comment"
                                                                                placeholder="comments ..." rows="3"
                                                                                class="form-control mb-2 ms-5 rounded-3"></textarea>
                                                                            <div class="">
                                                                                <button
                                                                                    class="btn btn-primary me-2 float-right">
                                                                                    Submit
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </form>
                                                        </template>

                                                    </div>
                                                    <div class=" p-0  text-center py-5 mb-3 rounded" v-else>
                                                        <Link :preserve-scroll="true" href="/"
                                                            class="btn btn-block  btn-primary">
                                                        Please
                                                        sign-in
                                                        for write comments</Link>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-4">
                        <h5 data-aos="fade-left" data-aos-duration="2000">Blogs Categories</h5>
                        <div class="heading-line" data-aos="fade-right" data-aos-duration="2000"></div>
                        <ul class="mb-5" data-aos="zoom-in" data-aos-duration="2000">
                            <li>
                                <Link :preserve-scroll="true" href="/">All Posts</Link>
                            </li>
                            <li class="my-2" v-for=" category  in  props.category " :key="category.id">
                                <Link :preserve-scroll="true" :href="`/searchByCategory/${category.id}`">{{
                                category.name }}
                                </Link>
                            </li>
                        </ul>
                        <h5 data-aos="fade-left" data-aos-duration="2000">Blogs You May Like</h5>
                        <div class="heading-line" data-aos="fade-right" data-aos-duration="2000"></div>
                        <Link :preserve-scroll="true" v-for=" post  in  props.postUMayLike "
                            :href="`/post/${post.id}/details`">
                        <div class="recent-blog border overflow-hidden rounded p-2 my-1 d-flex justify-content-between align-items-center"
                            data-aos="zoom-in" data-aos-duration="2000">
                            <img :src="`/storage/post/${post.image}`" style="width: 130px;" alt="">
                            <div class="ms-2">
                                {{ subString(post.content, 80) }}
                            </div>
                        </div>
                        </Link>
                        <Link :preserve-scroll="true" href="/" class="btn btn-primary my-3">Back TO Home</Link>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <svg xmlns="http://www.w3.org/2000/smethodvg" viewBox="0 0 1440 320" id="footer-wave">
                <path fill="#6366f1" fill-opacity="1"
                    d="M0,32L48,37.3C96,43,192,53,288,90.7C384,128,480,192,576,192C672,192,768,128,864,117.3C960,107,1056,149,1152,149.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
            </svg>
            <footer id="footer" class="d-flex justify-content-center align-items-center">
                <div class="container">
                    <div>&copy; 2023 Hornbill Technology, Inc. All rights reserved.</div>
                </div>
            </footer>
        </div>

        <!-- sign up  -->

        <Login></Login>
        <!-- sign in  -->
        <Register></Register>
    </Layout>
</template>

<script setup>
import Layout from './Layout.vue';
import Register from './../Auth/Login.vue';
import Login from './../Auth/Register.vue'
import moment from 'moment';
import { useToast } from 'vue-toastification';


const toast = useToast();


import { computed, ref } from 'vue'
import { Link, useForm, usePage } from '@inertiajs/vue3'
import { toastInjectionKey } from 'vue-toastification';

const props = defineProps({
    'post': Object,
    'category': Object,
    'postUMayLike': Object,
    'comments': Object,
    'like': Object,
    'likes': Number,
    'commentsCount': Number,
})

const page = usePage()
const authUser = computed(() => page.props.auth.user)
const form = useForm({
    'post_id': props.post.id,
    'comment': ''
})
const storeComment = () => {
    // console.log(form.user_id)
    form.post('/comment', {
        'post_id': form.post_id,
        'comment': form.comment,
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            toast.success('Successfully Commented')

        },
        onError: () => {
            toast.error('Retry to Comment')
        }


    })
}
const formatDate = (date) => {
    return moment(date).fromNow();
};



// const formatDate = (date) => {
//     // Format the date as desired (e.g., 'YYYY-MM-DD HH:MM:SS')
//     return `${date.toLocaleDateString()} ${date.toLocaleTimeString([], { hour: 'numeric', minute: '2-digit', hour12: true })}`;

// }
const subString = (string, num) => {
    if (string.length > num) {
        return string.substring(0, num) + '...'
    }
    return string
}

const subStringUser = (string, num) => {
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
const editForm = useForm({
    hoveredComment: null,
    editingComment: null,
    editedComment: ref('') // String to hold edited comment
});
const hoverComment = useForm({
    hoverId: null
})
const startEditing = (id) => {
    // console.log(id)
    editForm.editingComment = id
    editForm.editedComment = props.comments.find(comment => comment.id === id).comment;
    hoverComment.hoverId = editForm.editingComment
    // console.log(editForm.editedComment)
}
const cancelEdit = (id) => {
    editForm.editingComment = null
    editForm.editedComment = ''
}
const saveEdit = (id) => {
    editForm.patch(`/comment/${id}`,
        {
            comment: editForm.editedComment,
            post_id: form.post_id,
            preserveScroll: true,
            onSuccess: () => {
                toast.success('Comment edited successfully')
            }
        })
    editForm.editingComment = null
    editForm.editedComment = ''
}
const deleteComment = (id) => {
    // console.log(`/comment/${id}`)
    editForm.delete(`/comment/${id}`,
        {
            preserveScroll: true,
            onSuccess: () => {
                toast.success("Successfully deleted your comment.")
            }
        })
}
const likeForm = useForm({
    'post_id': props.post.id,
    'like': 'like'
})
const likePost = () => {
    if (props.like == null) {
        likeForm.post('/like', {
            preserveScroll: true,
            onSuccess: () => {
                likeForm.reset();
                toast.success('Successfully liked this post')
            }
        })
        console.log('Like')
    } else {
        likeForm.post('/unlike', {
            preserveScroll: true,
            onSuccess: () => {
                likeForm.reset();
                toast.success('Successfully unliked this post')
            }
        })
    }
}

</script>

<style lang="scss" scoped></style>
