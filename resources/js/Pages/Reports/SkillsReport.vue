<template>
    <Head title="Skills Report"/>
    <Header :hide-sections="true"/>
<!--    <section id="skillsReport" class="">-->
        <div class="container mx-auto h-full flex items-center bg-light-primary dark:bg-dark-primary py-32 lg:py-0 justify-center">
            <div class="table-title position-absolute flex-col md:flex-row items-center h-full pt-8 ">
                <h1 style="margin-top: 100px" class="text-xl leading-[32px] md:text-2xl md:leading-[1.2] font-bold md:traking-[-2px]">
                    Skills Report
                </h1>
                <div class="inline-flex">
                    <vue3-datepicker v-model="startDate" week-numbers="iso" style="max-width: 125px" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"/>
                    <vue3-datepicker v-model="endDate" week-numbers="iso" style="max-width: 125px" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"/>
                </div>
                <div class="py-12 flex justify-center items-center">
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
                                                Skill
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Date added
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="skill in skills"
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ skill.id }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ skill.name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ skill.updated_at }}
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
<!--    </section>-->
    <Footer/>
</template>

<script>
import Header from "@/Components/Frontend/Header.vue";
import Footer from "@/Components/Frontend/Footer.vue";
import moment from "moment";
import Vue3Datepicker from 'vue3-datepicker';
import {ref} from "vue";
export default {
    name: "SkillsReport",
    components: {Footer, Header, moment, Vue3Datepicker, ref},
    data() {
        return {
            skills: [],
            startDate: ref(new Date()),
            endDate: ref(new Date()),
            loading: true,
        }
    },
    mounted() {
        this.getSkills();
    },
    methods: {
        getSkills() {
            let start = this.startDate.getFullYear() + '-' + this.startDate.getMonth() + '-' + this.startDate.getDate();
            let end = this.endDate.getFullYear() + '-' + this.endDate.getMonth() + '-' + this.endDate.getDate();
            axios.get('/reports/get-skills?startDate=' + start + '&endDate=' + end).then(response => {
                this.skills = response.data
                this.loading = false;
            })
        },
    },
    watch: {
        startDate(newDate, oldDate) {
            this.getSkills();
        },
        endDate(newDate, oldDate) {
            this.getSkills();
        },
    }
}
</script>


<!--<style scoped>-->
<!--.table-title {-->
<!--    position: absolute;-->
<!--}-->
<!--</style>-->
