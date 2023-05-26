
<template>
    <Head title="Edit Application"/>
    <Header/>
        <div class="py-12">
            <div class="max-w-md mx-auto sm:px-6 lg:px-8 bg-white">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form class="p-4" @submit.prevent="submit">
                            <div>
                                <InputLabel for="skill" value="Skill" />
                                <Multiselect
                                    id="multiselect"
                                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
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
                                    class="mt-1 block w-full"
                                    @input="form.cover_letter = $event.target.files[0]"

                                />
                                <!--                                    @input="form.image = $event.target.files[0]"-->

                                <InputError class="mt-2" :message="form.errors.cover_letter" />
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

                            <div class="flex items-center justify-end mt-4">

                                <PrimaryButton class="ml-4" type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Update
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Multiselect from '@vueform/multiselect';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, router, useForm} from '@inertiajs/vue3';
import {computed, onMounted} from "vue";
import FileUpload from "@/Components/FileUpload.vue";

const props = defineProps({
    skills: Array
})

let form = useForm( {
    name: '',
    cv: null,
    cover_letter: null,
    skills: [],
    project_url: "",
    errors: [],
});

const submit = () => {
    router.post(`/applications/${props.applications.id}`,{
        _method: "put",
        name: form.name,
        cv: form.cv,
        cover_letter: form.cover_letter,
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

<!--<script>-->
<!--import {router} from "@inertiajs/vue3";-->
<!--import Multiselect from '@vueform/multiselect';-->
<!--import {useForm} from "@inertiajs/vue3";-->
<!--export default {-->
<!--    components: {-->
<!--        Multiselect,-->
<!--    },-->

<!--    mounted() {-->
<!--        this.options = this.skills.map(item => {-->
<!--            return item.name-->
<!--        });-->
<!--    },-->
<!--    data() {-->
<!--        return {-->
<!--            options: [],-->
<!--            form: {-->
<!--                name: '',-->
<!--                image: null,-->
<!--                skills: [],-->
<!--                project_url: "",-->
<!--                errors: [],-->
<!--            }-->
<!--        }-->
<!--    },-->
<!--    methods: {-->
<!--        // submit() {-->
<!--        //     console.log(route('projects.store'));-->
<!--        //     router.post(route('projects.store'),-->
<!--        //         this.form,-->
<!--        //         {-->
<!--        //             headers: {-->
<!--        //                 'Content-Type': 'multipart/form-data'-->
<!--        //             }-->
<!--        //         });-->
<!--        // },-->
<!--        test(event) {-->
<!--            console.log(event.target.files[0]);-->
<!--            this.form.image = event.target.files[0];-->
<!--            console.log('form-image', this.form.image);-->
<!--        }-->
<!--    }-->
<!--}-->
<!--</script>-->

<style src="@vueform/multiselect/themes/default.css"></style>
