<!--<script>-->

<!--</script>-->
<script setup>
import Multiselect from '@vueform/multiselect';
import {useForm} from "@inertiajs/vue3";
import InputLabel from '@/Components/InputLabel.vue';
import {computed} from "vue";
import "@vueform/multiselect/themes/default.css";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Header from "@/Components/Frontend/Header.vue";
import Project from "@/Components/Sections/Project.vue";
import FileUpload from "@/Components/FileUpload.vue";
import ProjectApplications from "@/Components/Frontend/ProjectApplications.vue";
import InputError from "@/Components/InputError.vue";
import { Carousel, Slide } from 'vue3-carousel';
import 'vue3-carousel/dist/carousel.css';

import { ref, watch } from 'vue';
import axios from 'axios';

const file1 = ref(null);
const file2 = ref(null);
const currentSlide = ref(0);

watch(currentSlide, (newSlide) => {
    form.selectedProject = props.projects.data[newSlide];
    form.project_url = form.selectedProject.project_url;
    form.project_id = form.selectedProject.id;
});

// const slideTo = (project) => {
//     console.log('slideTo');
//     // Implementation of slideTo method goes here
// };


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
    project_url: "",
    errors: [],
});

const options = computed(() =>
    props.skills.data.map(item => {
        return item.name
    })
)

// const submit = () => {
//     form.post(route('applications.store'), {
//         onSuccess: () => form.reset(),
//     });
// };

// function clickProject(project) {
//     form.selectedProject = project
//     form.project_url = project.project_url
//     form.project_id = project.id
// }

</script>

<template>
    <Head title="Apply for jobs"/>
    <Header :hide-sections="true"/>
    <div class="container mx-auto">
        <nav class="mb-24 border-b-2 border-light-tail-100 dark:text-dark-navy-100"/>
<!--        <section class="grid gap-y-12 lg:grid-cols-3 lg:gap-8">-->
<!--            <div class="project" v-for="project in projects.data"-->
<!--                 :class="form.selectedProject === project ? 'project-wrapper is-selected' : 'project-wrapper'"-->
<!--                 @click="clickProject(project)"-->
<!--            >-->
<!--                <ProjectApplications :key="project.id" :hideLink="true" :project="project" />-->
<!--            </div>-->
<!--            {{projects.data.length - 1}}-->
<!--            <span v-for="i in (projects.data.length)">-->
<!--                I: {{projects.data[i-1].name}}-->
<!--            </span>-->
            <Carousel id="gallery" :items-to-show="1" :wrap-around="false" v-model="currentSlide">
                <Slide v-for="project in projects.data" :key="project">
                    <div class="carousel__item">
                        <ProjectApplications :key="project" :hideLink="true" :project="project" />
                    </div>
                </Slide>
            </Carousel>

            <Carousel
                id="thumbnails"
                :items-to-show="4"
                :wrap-around="true"
                v-model="currentSlide"
                ref="carousel"
            >
<!--                {{ projects.data[0]}}-->
                <Slide v-for="project in projects.data" :key="project" @click="slideTo(project)">
                    <div class="carousel__item" @click="slideTo(project)">
                        <ProjectApplications :key="project" :hideLink="true" @click="slideTo(project)" :project="project" />
<!--                        {{project.name}}-->
                    </div>
                </Slide>
            </Carousel>

<!--        </section>-->
    </div>

    <div class="py-12">
        <div class="max-w-md mx-auto p-6 sm:px-6 lg:px-8 bg-light-primary">
            <div class="bg-light-secondary overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form class="p-4" @submit.prevent="submit" :key="form.selectedProject">
                        <div class="mb-3">
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
<!--                                <InputError class="mt-2" :message="form.errors.skills" />-->
                            </div>
                            <div class="mb-3 p-5 text-gray-900">
                                <label class="form-label" for="name">Name:</label>
                                <input class="form-control" type="text" id="name" v-model="form.name">
                            </div>

                            <div class="mb-3 p-5 text-gray-900">
                                <label for="formFile" class="form-label">CV: </label>
                                <file-upload class="form-control" id="formFile" v-model="form.cv"/>
                            </div>

                            <div class="mb-3 p-5 text-gray-900">
                                <label for="formFile" class="form-label">Cover letter: </label>
                                <file-upload class="form-control" id="formFile" v-model="form.cover_letter"/>
                            </div>

                            <div class="mb-3 p-5 text-gray-900">
                                <label for="project_url" class="form-label">Project link: </label>
                                <input class="form-control" type="text" id="project_url" v-model="form.project_url">
                            </div>
                            <div class="flex items-center justify-end mt-4">

                                <PrimaryButton class="ml-4" type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Store
                                </PrimaryButton>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<style scoped>
    .project-wrapper {
        text-align: center;
        margin-right: auto;
        margin-left: auto;
        padding: 5px;
    }

    .is-selected {
         border-radius: 10px;
         border: 6px solid lightskyblue;
    }

    .multiselect {
        z-index: 0
    }

 /*img{*/
 /*    display: flex;*/
 /*}*/
</style>
