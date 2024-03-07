<template>
    <Layout>
        <div class="row">
            <div class=" p-5">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3>Post Lists</h3>
                            <div class="">
                                <Link class="btn btn-primary" href="/admin/posts/create">Create</Link>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th class="border-right">No</th>
                                        <th class="border-right">Title</th>
                                        <th class="border-right">Content</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="post in posts" :key="post.id">
                                        <td class="border-right">{{ post.id }}</td>
                                        <td class="border-right">{{ post.title }}</td>
                                        <td class="border-right">
                                            <p>{{ subString(post.content, 100) }}</p>

                                        </td>
                                        <td>
                                            <div class="">
                                                <Link :href="`/admin/posts/${post.id}/edit`"
                                                    class="btn btn-primary btn-sm mb-2 me-2">Edit
                                                </Link>
                                                <Link :href="`/admin/posts/${post.id}`" method="delete" as="button"
                                                    class="btn btn-danger btn-sm bg-danger mb-2 me-2">
                                                Delete
                                                </Link>
                                                <Link class="btn btn-success btn-sm mb-2" :href="`/admin/posts/${post.id}`">
                                                Details
                                                </Link>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Layout from './../Layout.vue';
defineProps(['posts'])

const subString = (string, num) => {
    if (string.length > num) {
        return string.substring(0, num) + '...'
    }
    return string
}
</script>

<style lang="scss" scoped></style>
