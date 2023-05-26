<template>
    <Head title="Applications Index"/>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Applications</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
                                    <th scope="col" class="px-6 py-3">

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
                                        {{ application.skill.name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <file-upload class="form-control" id="formFile" v-model="application.cv"/>
                                    </td>
                                    <td class="px-6 py-4">
                                        <file-upload class="form-control" id="formFile" v-model="application.cover_letter"/>
                                    </td>
                                    <td class="px-6 py-4">
                                        <file-upload class="form-control" id="formFile" v-model="application.project_url"/>
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
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import FileUpload from "@/Components/FileUpload.vue";

defineProps(
    {
        projects: Object,
        applications: Object,
    }
);
</script>
