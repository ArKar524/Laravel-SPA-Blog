<template>
    <Layout>

        <div class=" p-5">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3>Category List</h3>
                        <div class="">
                            <Link class="btn btn-primary" href="/admin/category/create">Create</Link>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="category in categories" :key="category.id">
                                <td>
                                    {{ category.id }}
                                </td>
                                <td>
                                    {{ category.name }}
                                </td>
                                <td>
                                    <Link :href="`/admin/category/${category.id}/edit`" class="btn btn-primary">Edit</Link>
                                    <Link :href="`/admin/category/${category.id}/delete`" custom="true" method="post"
                                        as="button" class="btn btn-danger bg-danger mx-2">
                                    Delete
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Layout from '../Layout.vue';
defineProps(['categories'])
</script>

<style lang="scss" scoped></style>
