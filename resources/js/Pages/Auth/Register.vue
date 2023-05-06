<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {router} from "@inertiajs/vue3";
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
    token: null,
});

const submit = () => {
    let queryString = window.location.search;
    let urlParams = new URLSearchParams(queryString);
    form.token = urlParams.has('token') ? urlParams.get('token') : null;
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<script>
export default {
    data() {
        return {
            token: '$2a$10$La/BCYuj3SE6Z0RPzYbNTORAyxjXyQIdLxFkADpfMG4HlEIs2Idqm',
        }
    },
    mounted() {
        // let queryString = window.location.search;
        // let urlParams = new URLSearchParams(queryString);
        // let token = '$2a$10$La/BCYuj3SE6Z0RPzYbNTORAyxjXyQIdLxFkADpfMG4HlEIs2Idqm'
        // // console.log('window', queryString);
        // // console.log('urlParams', urlParams.has('token'), urlParams.get('token'));
        // console.log('token', this.token);
        // console.log('urlToken', urlParams.get('token'));
        // console.log(urlParams.has('token') && urlParams.get('token') === this.token);
        console.log(this.isRecruiter)
    },
    computed: {
        isRecruiter() {

            return (urlParams.has('token') && urlParams.get('token') === this.token);
        }
    }
}

</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Already registered?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
