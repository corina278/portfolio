<template>
    <Header :hide-sections="true"/>
        <div class="py-12 bg-amber-50">
            <div  style="padding-top: 70px" class="max-w-7xl mx-auto sm:px-6 lg:p-8 bg-light-primary rounded-xl">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg bg-light-secondary">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-end m-2 p-2">
                            <Link :href="route('applications.create')"
                                  class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 text-white rounded-md">
                                New Application
                            </Link>
                        </div>
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Skill
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        CV
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Cover Letter
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Project URL
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="application in applications.data" :key="application.id"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ application.id }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ application.name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <ul>
                                            <li v-for="skill in application.skills">
                                                {{ skill }}
                                            </li>
                                        </ul>
                                    </td>
                                    <td class="px-6 py-4">
                                        <i class="fa fa-download" @click="downloadFile(application.cv)" aria-hidden="true"></i>
                                    </td>
                                    <td class="px-6 py-4">
                                        <i class="fa fa-download" @click="downloadFile(application.cover_letter)" aria-hidden="true"></i>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{application.project_url}}
                                    </td>
                                    <td class="px-6 py-4">
                                        <Link :href="route('applications.edit', application.id)"  class="font-medium text-blue-500 hover:text-blue-700 mr-2">Edit</Link>
                                        <Link :href="route('applications.destroy', application.id)" method="delete" as="button" type="button" class="font-medium text-red-500 hover:text-red-700 mr-2">Delete</Link>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <Footer/>
</template>

<script setup>
import {Link} from '@inertiajs/vue3';
import FileUpload from "@/Components/FileUpload.vue";
import Header from "@/Components/Frontend/Header.vue";
import Footer from "@/Components/Frontend/Footer.vue";

defineProps(
    {
        projects: Object,
        applications: Object,
    }
);

function downloadFile(url) {
    window.location.assign(url);
}
</script>

<style src="../../../css/font-awesome-4.7.0/css/font-awesome.css"></style>
