
<template>
    <Head title="New Application"/>
    <Header/>
        <div style="padding: 150px" class="py-12 bg-amber-50 ">
            <div class="max-w-md mx-auto sm:px-6 lg:p-8 bg-light-primary rounded-xl">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form class="p-4" @submit.prevent="submit">
                            <div>
                                <InputLabel for="skill" value="Skill" />
                                <Multiselect
                                    id="multiselect"
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                    :options="options"
                                    v-model="form.skills"
                                    :value="form.skills"
                                    mode="multiple"
                                    placeholder="Choose skills"
                                    :hide-selected="false"/>
                                <!--                                    <option v-for="skill in skills" :key="skill.id" :value="skill.id">{{skill.name}}</option>-->
                                <InputError class="mt-2" :message="form.errors.skills" />
                            </div>

                            <div>
                                <InputLabel for="name" value="Name" />

                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    autofocus
                                    autocomplete="name"
                                />

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div class="mt-2">
                                <InputLabel for="cv" value="CV" />

                                <file-upload
                                    id="cv"
                                    type="file"
                                    class="mt-1 block w-full"
                                    @input="form.cv = $event.target.files[0]"

                                />
                                <!--                                    @input="form.image = $event.target.files[0]"-->

                                <InputError class="mt-2" :message="form.errors.cv" />
                            </div>
                            <div class="mt-2">
                                <InputLabel for="cover_letter" value="Cover Letter" />

                                <file-upload
                                    id="cover_letter"
                                    type="file"
                                    class="mt-1 block w-full py-1"
                                    @input="form.cover_letter = $event.target.files[0]"

                                />

                                <InputError class="mt-2" :message="form.errors.cover_letter" />
                            </div>
                            <div>
                                <InputLabel for="project_url" value="Project Name" />

                                <select name="project" id="project" v-model="form.project_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                    <option v-for="project in projects"
                                            :value="project.id">{{ project.name }}</option>
                                </select>
                            </div>

                            <div class="flex items-center justify-end mt-4">

                                <PrimaryButton class="ml-4" type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Store
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
import Multiselect from '@vueform/multiselect';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, router, useForm} from '@inertiajs/vue3';
import {computed, onMounted} from "vue";
import FileUpload from "@/Components/FileUpload.vue";
import Footer from "@/Components/Frontend/Footer.vue";

const props = defineProps({
    skills: Array,
    projects: Array
})

let form = useForm( {
    name: '',
    cv: null,
    cover_letter: null,
    skills: [],
    project_id: '',
    errors: [],
});

const submit = () => {
    form.post(route('applications.store'));
}

const options = computed(() =>
    props.skills.map(item => {
        return item.name
    })
)
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
