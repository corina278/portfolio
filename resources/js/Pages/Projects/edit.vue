<template>
    <Head title="New Project"/>
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

                                <InputError class="mt-2" :message="$page.props.errors.name" />
                            </div>

                            <div>
                                <InputLabel for="project_url" value="URL" />

                                <TextInput
                                    id="project_url"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.project_url"
                                    autocomplete="projecturl"
                                />

                                <InputError class="mt-2" :message="form.errors.project_url" />
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

                                <PrimaryButton class="ml-4">
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
import {router} from "@inertiajs/vue3";
import Multiselect from '@vueform/multiselect';
import {computed} from "vue";
import Footer from "@/Components/Frontend/Footer.vue";

const props = defineProps({
    skills: Array,
    project: Object,
});

const form = useForm({
    name: props.project?.name,
    image: null,
    skills: [],
    project_url: props.project?.project_url,
    errors: [],
});

const submit = () => {
    router.post(`/projects/${props.project.id}`,{
        _method: "put",
        name: form.name,
        image: form.image,
        skills: form.skills,
        project_url: form.project_url
})
}
const options = computed(() =>
    props.skills.map(item => {
        return item.name
    })
)
</script>
