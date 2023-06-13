<template>
    <Head title="Skills Report"/>
    <Header :hide-sections="true"/>
        <div class="container mx-auto h-full flex items-center bg-light-primary dark:bg-dark-primary py-32 lg:py-0">
            <div class="flex flex-col md:flex-row items-center h-full pt-8">
                <h1 class="text-l leading-[32px] md:text-2xl md:leading-[1.2] font-bold md:traking-[-2px]">
                    Applications Report
                </h1>
                <vue3-datepicker v-model="startDate" week-numbers="iso" style="max-width: 125px; margin: 10px" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"/>
                <vue3-datepicker v-model="endDate" week-numbers="iso" style="max-width: 125px; margin: 10px" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"/>

                <select name="project" v-model="selectedProject" style="max-width: 120px; margin: 10px" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                    <option v-for="project in projects" :value="project.id">{{project.name}}</option>
                </select>

                <div style="margin-top: 50px" class="py-12 p-10">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <div class="relative overflow-x-auto">
                                    <table class="w-full text-sm text-left  text-gray-500 dark:text-gray-400">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                ID
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Applicant's Name
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Applicant's CV
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Project
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Date added
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="application in applications"
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ application.id }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ application.name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <i class="fa fa-download" @click="downloadFile(application.cv)" aria-hidden="true"></i>
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ application.project.name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ application.updated_at }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <Footer/>
</template>

<script>
import Header from "@/Components/Frontend/Header.vue";
import Footer from "@/Components/Frontend/Footer.vue";
import moment from "moment";
import Vue3Datepicker from 'vue3-datepicker';
import {ref} from "vue";
import * as qs from "postcss";
export default {
    name: "SkillsReport",
    components: {Footer, Header, moment, Vue3Datepicker, ref},
    data() {
        return {
            applications: [],
            projects: [],
            selectedProject: null,
            startDate: ref(new Date()),
            endDate: ref(new Date()),
            loading: true,
        }
    },
    mounted() {
        this.getApplications();
        this.getProjects();
    },
    methods: {
        getProjects() {
            axios.get('/get-projects').then(response => {
                this.projects = response.data.data
            })
        },
        getApplications() {
            let start = this.startDate.getFullYear() + '-' + this.startDate.getMonth() + '-' + this.startDate.getDate();
            let end = this.endDate.getFullYear() + '-' + this.endDate.getMonth() + '-' + this.endDate.getDate();
            let url = '/reports/get-applications?startDate=' + start + '&endDate=' + end;
            url += this.selectedProject ? '&project=' + this.selectedProject : null
            axios.get(url).then(response => {
                this.applications = response.data
                this.loading = false;
            })
        },
        downloadFile(url) {
            window.location.assign(url);
        },
    },
    watch: {
        startDate(newDate, oldDate) {
            this.getApplications();
        },
        endDate(newDate, oldDate) {
            this.getApplications();
        },
        selectedProject(oldProject, newProject) {
            this.getApplications();
        },
    }
}

</script>

<style src="../../../css/font-awesome-4.7.0/css/font-awesome.css"></style>
