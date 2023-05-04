<script>
import Project from "@/Components/Sections/Project.vue";
import FileUpload from "@/Components/FileUpload.vue";
import ProjectApplications from "@/Components/Frontend/ProjectApplications.vue";

export default {
    props: {
        projects: {type: Object},
        skills: {type: Object}
    },
    components: {ProjectApplications, FileUpload, Project},
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

<template>
    <div class="container mx-auto">
        <nav class="mb-12 border-b-2 border-light-tail-100 dark:text-dark-navy-100">
            <ul class="flex flex-col lg:flex-row justify-evenly items-center">
                <li class="cursor-pointer capitalize m-4">
                    <button class="flex text-center px-4 py-2 hover:text-light-tail-500 dark:text-dark-navy-100">All</button>
                </li>
                <li class="cursor-pointer capitalize m-4" v-for="projectSkill in skills.data" :key="projectSkill.id">
                    <a class="flex text-center px-4 py-2 hover:text-light-tail-500 dark:text-dark-navy-100"
                       :href="getsKillUrl(projectSkill.name)">{{ projectSkill.name }}</a>
                </li>
            </ul>
        </nav>
        <section class="grid gap-y-12 lg:grid-cols-3 lg:gap-8">
            <div class="project" v-for="project in projects"
                 :class="form.selectedProject === project ? 'project-wrapper is-selected' : 'project-wrapper'"
                 @click="form.selectedProject = project"
            >
                <ProjectApplications :key="project.id" :hideLink="true" :project="project" />
            </div>

        </section>
    </div>

    <form @submit.prevent="submit">

        <div class="mb-3">
            <label class="form-label" for="name"> Enter Name</label>
            <input class="form-control" type="text" id="name">

            <label for="formFile" class="form-label">Default file input example</label>
            <file-upload class="form-control" id="formFile" v-model="form.file"/>
        </div>
        <button class="btn-primary" type="submit"></button>

    </form>
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
