<template>
    <Head title="Projects Report"/>
    <Header :hide-sections="true"/>
    <div class="container mx-auto h-full flex items-center bg-light-primary dark:bg-dark-primary py-32 lg:py-0">
        <div class="table-title position-absolute flex-col md:flex-row items-center h-full pt-8">
            <h1 style="margin-top: 100px" class="text-l leading-[32px] md:text-2xl md:leading-[1.2] font-bold md:traking-[-2px]">
                Project Report
            </h1>
            <div class="inline-flex p-3">
                <vue3-datepicker v-model="startDate" week-numbers="iso" style="max-width: 125px" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"/>
                <vue3-datepicker v-model="endDate" week-numbers="iso" style="max-width: 125px" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"/>
            </div>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <div v-if="!loading" class="relative overflow-x-auto">
                                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                ID
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
                                        <tr v-for="project in projects"
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ project.id }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ project.name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ project.updated_at }}
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
export default {
    name: "ProjectsReport",
    components: {Footer, Header, Vue3Datepicker, ref},
    data() {
        return {
            projects: [],
            startDate: ref(new Date()),
            endDate: ref(new Date()),
            loading: true,
        }
    },
    mounted() {
        this.getProjects();
    },
    methods: {
        getProjects() {
            let start = this.startDate.getFullYear() + '-' + this.startDate.getMonth() + '-' + this.startDate.getDate();
            let end = this.endDate.getFullYear() + '-' + this.endDate.getMonth() + '-' + this.endDate.getDate();
            axios.get('/reports/get-projects?startDate=' + start + '&endDate=' + end).then(response => {
                this.projects = response.data
                this.loading = false;
            })
        },
    },
    watch: {
        startDate(newDate, oldDate) {
            this.getProjects();
        },
        endDate(newDate, oldDate) {
            this.getProjects();
        },
    }
}
</script>
