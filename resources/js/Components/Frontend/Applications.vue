<script>
import Project from "@/Components/Sections/Project.vue";
import FileUpload from "@/Components/FileUpload.vue";
import ProjectApplications from "@/Components/Frontend/ProjectApplications.vue";
import InputError from "@/Components/InputError.vue";

export default {
    props: {
        projects: {type: Object},
        skills: {type: Object}
    },
    components: {InputError, ProjectApplications, FileUpload, Project},
    data() {
        return {
            file1: null,
            file2: null,
            form: {
                file: null,
                selectedProject: null
            }
        }

    },
    methods: {
        getsKillUrl(skill) {
            return 'projects?skill=' +   skill
        },
        submit() {
            // axios.post('/url', this.form).then(data => {
            //     console.log(data);
            // })
        }
    }
}
</script>
<script setup>
import Multiselect from '@vueform/multiselect';
import {useForm} from "@inertiajs/vue3";
import InputLabel from '@/Components/InputLabel.vue';
import {computed} from "vue";

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

// const options = computed(() =>
//     props.skills.map(item => {
//         return item.name
//     })
// )
</script>

<template>
    <Head title="Apply for jobs"/>
    <div class="container mx-auto">
        <nav class="mb-24 border-b-2 border-light-tail-100 dark:text-dark-navy-100"/>
        <section class="grid gap-y-12 lg:grid-cols-3 lg:gap-8">
            <div class="project" v-for="project in projects"
                 :class="form.selectedProject === project ? 'project-wrapper is-selected' : 'project-wrapper'"
                 @click="form.selectedProject = project"
            >
                <ProjectApplications :key="project.id" :hideLink="true" :project="project" />
            </div>

        </section>
    </div>

    <div class="py-12">
        <div class="max-w-md mx-auto p-6 sm:px-6 lg:px-8 bg-light-primary">
            <div class="bg-light-secondary overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form class="p-4" @submit.prevent="submit">
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
                                <InputError class="mt-2" :message="form.errors.skills" />
                            </div>
                            <div class="mb-3 p-5 text-gray-900">
                                <label class="form-label" for="name">Name:</label>
                                <input class="form-control" type="text" id="name">
                            </div>

                            <div class="mb-3 p-5 text-gray-900">
                                <label for="formFile" class="form-label">CV: </label>
                                <file-upload class="form-control" id="formFile" v-model="form.file"/>
                            </div>

                            <div class="mb-3 p-5 text-gray-900">
                                <label for="formFile" class="form-label">Cover letter: </label>
                                <file-upload class="form-control" id="formFile" v-model="form.file"/>
                            </div>

                            <div class="mb-3 p-5 text-gray-900">
                                <label for="project_url" class="form-label">Project link: </label>
                                <input class="form-control" type="text" id="project_url" v-model="form.project_url">
                            </div>
                            <button class="btn-primary" type="submit"></button>
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
 /*img{*/
 /*    display: flex;*/
 /*}*/
</style>
