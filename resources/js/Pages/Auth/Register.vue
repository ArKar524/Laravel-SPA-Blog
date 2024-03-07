<template>
    <div>
        <div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="signUp"
            aria-labelledby="signUpLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="signUpLabel">Sign Up</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="">
                    <form @submit.prevent="registerUser">
                        <div class="mb-2">
                            <input type="text" name="name" v-model="form.name" class="form-control" placeholder="name">
                            <span class="text-danger">{{ form.errors.name }}</span>
                        </div>
                        <div class="mb-2">
                            <input type="text" name="email" v-model="form.email" class="form-control" placeholder="email">
                            <span class="text-danger">{{ form.errors.email }}</span>
                        </div>
                        <div class="mb-2">
                            <input type="password" name="password" v-model="form.password" class="form-control"
                                placeholder="password">
                            <span class="text-danger">{{ form.errors.password }}</span>
                        </div>
                        <button class="btn btn-block btn-primary">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import { useForm } from '@inertiajs/vue3';
const form = useForm({
    name: '',
    email: '',
    password: ''
})

const registerUser = () => {
    form.post('/register', {
        onSuccess: () => {
            form.reset();
            window.location.href = '/';
            alert('Registration is successfully finished! . Please Login.')
        },
        onError: () => {
            form.reset();
            alert('Please retry your Registration')
        }
    })
    form.reset()
    console.log(form.name)
}
</script>

<style lang="scss" scoped></style>