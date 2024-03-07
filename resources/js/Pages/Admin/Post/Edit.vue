<template>
    <Layout>

        <div class=" p-5">
            <form @submit.prevent="updatePost">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3>Post Lists</h3>
                            <div class="">
                                <Link class="btn btn-primary" href="/admin/posts">Back</Link>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class=" mb-2">
                            <label for="">Category</label>

                            <select class="form-control" v-model="form.category_id" name="category" id="">
                                <option value="">Select Category</option>
                                <template v-for="category in  props.categories  ">
                                    <option class="form-control" :value="category.id">
                                        {{ category.name }}
                                    </option>
                                </template>
                            </select>
                            <span class="text-danger" v-if="form.errors.category_id">{{ form.errors.category_id
                            }}</span>
                        </div>
                        <div class=" mb-2">
                            <label for="">Title</label>
                            <input type="text" v-model="form.title" name="name" class="form-control"
                                placeholder="Enter Title ...">
                            <span class="text-danger" v-if="form.errors.title">{{ form.errors.title }}</span>
                        </div>
                        <div class=" mb-2">
                            <label for="">Content</label>
                            <textarea class="form-control textarea" name="content" cols="30" v-model="form.content"
                                rows="10" placeholder="Enter Content ..."></textarea>
                            <span class="text-danger" v-if="form.errors.content">{{ form.errors.content }}</span>
                        </div>
                        <div class="mb-2">
                            <label for="">Image</label>
                            <input type="file" name="image" class="form-control " accept="image/*"
                                @input="form.image = $event.target.files[0]">
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}
                            </progress>
                            <span class="text-danger" v-if="form.errors.image">{{ form.errors.image }}</span>
                        </div>
                        <div class="w-150 mb-2">
                            <img :src="`/storage/post/${post.image}`" alt="" class="w-150" style="width: 100px;">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>

        </div>
    </Layout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Layout from '../Layout.vue';
import { useForm } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';

const toast = useToast()
const props = defineProps({
    post: Object,
    categories: Object,
})

const form = useForm({
    category_id: props.post.category_id,
    title: props.post.title,
    content: props.post.content,
    image: '',
})

const updatePost = () => {
    form.post(`/admin/posts/${props.post.id}`, {
        multipart: true,
        onSuccess: () => {
            toast.success('Post Updated Successfully')
            form.reset()
        }
    })
}

</script>

<style lang="scss" scoped></style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css"></link>