<template>
    <Layout>

        <div class=" p-5">
            <form @submit.prevent="updateCategory()">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3>Category Edit</h3>
                            <div class="">
                                <Link class="btn btn-primary" href="/admin/categories">Back</Link>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <label for="">Name</label>
                            <input type="text" v-model="form.name" name="name" class="form-control"
                                placeholder="Enter Title ...">
                            <span class="text-danger" v-if="form.errors.name">{{ form.errors.name }}</span>
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
    category: Object,
})

const form = useForm({
    name: props.category.name,
})

const updateCategory = () => {
    form.post(`/admin/category/${props.category.id}/update`,
        {
            onSuccess: () => {
                toast.success('Category Updated Successfully')
                form.reset()
            },
            onError: () => {
                toast.error('Something went wrong')
            }
        })
}
</script>

<style lang="scss" scoped></style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css"></link>