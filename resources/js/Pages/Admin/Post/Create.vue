<template>
    <Layout>

        <div class=" p-5">
            <form @submit.prevent="createPost">
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
                        <div class="">
                            <label for="">Category</label>
                            <select class="form-control" v-model="form.category_id" name="" id="">
                                <option class="form-control" value="">Select Category</option>
                                <option class="form-control" v-for="category in categories" :value="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                            <span class="text-danger" v-if="form.errors.category_id">{{ form.errors.category_id
                            }}</span>
                        </div>
                        <div class="">
                            <label for="">Title</label>
                            <input type="text" v-model="form.title" name="name" class="form-control"
                                placeholder="Enter Title ...">
                            <span class="text-danger" v-if="form.errors.title">{{ form.errors.title }}</span>
                        </div>
                        <div class="">
                            <label for="">Content</label>
                            <textarea class="form-control" name="content" cols="30" v-model="form.content" rows="10"
                                placeholder="Enter Content ..."></textarea>
                            <span class="text-danger" v-if="form.errors.content">{{ form.errors.content }}</span>
                        </div>
                        <div class="">
                            <label for="">Image</label>
                            <input type="file" name="image" class="form-control" placeholder="Enter Title ..."
                                @input="form.image = $event.target.files[0]">
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}
                            </progress>
                            <span class="text-danger" v-if="form.errors.image">{{ form.errors.image }}</span>
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

const toast = useToast();
defineProps(['categories'])
const form = useForm({
    category_id: '',
    title: '',
    content: '',
    image: ''
})

const createPost = () => {
    form.post('/admin/posts', {
        forceFormData: true,
        onSuccess: () => {
            toast.success('Post created Successfully')
            form.reset()
        }
    })
}
</script>

<style lang="scss" scoped></style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css"></link>