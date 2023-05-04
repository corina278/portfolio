<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Sections from "@/Layouts/Sections.vue";

defineProps({
    skills: Object,
    projects: Object,
})
</script>

<template>
    <Head title="Welcome to portofolio!" />
    <Sections :skills="skills" :projects="projects.data"/>
</template>


