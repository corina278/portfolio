<template>
    <Head title="Edit Skill"/>
    <Header/>
        <div style="padding: 150px" class="py-12 bg-amber-50 ">
            <div class="max-w-md mx-auto sm:px-6 lg:p-8 bg-light-primary rounded-xl">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form class="p-4" @submit.prevent="submit">
                            <div>
                                <InputLabel for="name" value="Name" />

                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    autofocus
                                    autocomplete="username"
                                />

                                <InputError class="mt-2" :message="$page.props.errors.name" />
                            </div>

                            <div class="mt-2">
                                <InputLabel for="image" value="Image" />

                                <TextInput
                                    id="image"
                                    type="file"
                                    class="mt-1 block w-full"
                                    @input="form.image = $event.target.files[0]"
                                />

                                <InputError class="mt-2" :message="$page.props.errors.image" />
                            </div>

                            <div class="flex items-center justify-end mt-4">

                                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Update
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <Footer/>
</template>

<script setup>
import Header from "@/Components/Frontend/Header.vue";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'
import Footer from "@/Components/Frontend/Footer.vue";

const props = defineProps({
    skill: Object,
});

const form = useForm({
    name: props.skill?.name,
    image: null,
});

const submit = () => {
    router.post(`/skills/${props.skill.id}`, {
        _method: "put",
        name: form.name,
        image: form.image,
    });
};
</script>
