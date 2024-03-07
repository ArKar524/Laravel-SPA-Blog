<template>
    <div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="signIn"
        aria-labelledby="signInLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="signInLabel">Sign In</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="">
                <form @submit.prevent="loginUser">
                    <div class="mb-2">
                        <input type="text" name="email" v-model="form.email" class="form-control" placeholder="email">
                    </div>
                    <div class="mb-2">
                        <input type="password" name="password" v-model="form.password" class="form-control"
                            placeholder="password">
                        <span class="text-danger">{{ form.errors.email }}</span>

                    </div>

                    <button class="btn btn-block btn-primary">Sign In</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';

const toast = useToast()
const form = useForm({
    email: '',
    password: ''
})
const page = usePage()

const loginUser = () => {
    form.post('/login', {
        onSuccess: () => {
            form.reset();
            toast.success('Login successful')
            if (page.props.auth.user.role == 'user') {
                window.location.reload('/')

            }

        },




        onError: () => {
            alert('Please retry your login')
        }
    })

    form.reset()
}


</script>

<style lang="scss" scoped></style>