<script setup>
import Projects from "@/Components/Sections/Projects.vue";

defineProps({
    skills: Object,
    projects: Object
})
</script>
<template>
    <section id="portfolio" class="section bg-light-primary dark:bg-dark-primary min-h-[1400px]">
        <div class="container mx-auto" v-motion :initial="{ opacity: 0, y: 100, }" :visible="{ opacity: 1, y: 0, }">
            <div class="flex flex-col items-center text-center">
                <h2 class="section-title">My latest work</h2>
                <p class="subtitle">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                </p>
            </div>
            <Projects :skills="skills" :projects="projects"/>
        </div>
    </section>
</template>
