<template>
    <Head title="Skills Index"/>
    <Header :hide-sections="true"/>
        <div class="py-12 bg-amber-50">
            <div  style="padding-top: 70px" class="max-w-7xl mx-auto sm:px-6 lg:p-8 bg-light-primary rounded-xl">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg bg-light-secondary">
                    <div class="p-6 text-gray-900 bg-white">
                        <div class="flex justify-end m-2 p-2 ">
                            <Link :href="route('skills.create')"
                                  class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 text-white rounded-md"> New Skill
<!--                            <-merge si "/skills/create">-->
                            </Link>
                        </div>

                        <div class="relative overflow-x-auto ">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 bg-white">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 bg-fuchsia-100">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Image
                                    </th>
                                    <th scope="col" class="px-6 py-3">

                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="skill in skills.data" :key="skill.id"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ skill.id }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ skill.name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <img :src="skill.image" class="w-14 h-14 rounded-full"/>
                                    </td>
                                    <td class="px-6 py-4">
                                        <Link :href="route('skills.edit', skill.id)"  class="font-medium text-blue-500 hover:text-blue-700 mr-2">Edit</Link>
                                        <Link :href="route('skills.destroy', skill.id)" method="delete" as="button" type="button" class="font-medium text-red-500 hover:text-red-700 mr-2">Delete</Link>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script setup>
import {Head, Link} from '@inertiajs/vue3';
import Header from "@/Components/Frontend/Header.vue";

defineProps({
    skills: Object,
});
</script>
