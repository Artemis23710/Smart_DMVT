<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>
<style>
        .login-clean {
            
            padding: 80px;
            width: 100%;
            height: 100%;
        }

        .login-clean form {
            max-width: 320px;
            width: 100%;
            height: 100%;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 4px;
            color: #505e6c;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.1);
        }

        .login-clean .illustration {
            text-align: center;
            padding: 0 0 20px;
            font-size: 100px;
            color: rgb(244, 71, 107);
        }

        .login-clean form .form-control {
            background: #f7f9fc;
            border: none;
            border-bottom: 1px solid #dfe7f1;
            border-radius: 0;
            box-shadow: none;
            outline: none;
            color: inherit;
            text-indent: 8px;
            height: 42px;
        }

        .login-clean form .btn-primary {
            background: #f4476b;
            border: none;
            border-radius: 4px;
            padding: 11px;
            box-shadow: none;
            margin-top: 26px;
            text-shadow: none;
            outline: none !important;
        }

        .login-clean form .btn-primary:hover,
        .login-clean form .btn-primary:active {
            background: #eb3b60;
        }

        .login-clean form .btn-primary:active {
            transform: translateY(1px);
        }

        .login-clean form .forgot {
            display: block;
            text-align: center;
            font-size: 12px;
            color: #6f7a85;
            opacity: 0.9;
            text-decoration: none;
        }

        .login-clean form .forgot:hover,
        .login-clean form .forgot:active {
            opacity: 1;
            text-decoration: none;
        }
</style>


<template>
    <GuestLayout>
        <div class="login-clean">
            <form @submit.prevent="submit">
                
                <div class="illustration"><i class="icon ion-ios-navigate"></i></div>

                <div class="form-group" >
                    <input class="form-control" type="email" v-model="form.email" placeholder="Email">
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>
                <br>
                <div class="form-group">
                    <input class="form-control" type="password"  v-model="form.password" placeholder="Password">
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

                <div class="flex items-center justify-center mt-4">
                <PrimaryButton class="ms-4 btn btn-primary btn-block" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </PrimaryButton>
            </div>
        </form>
        </div>
       
    </GuestLayout>
</template>
