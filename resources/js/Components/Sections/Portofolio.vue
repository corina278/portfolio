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
                <h2 class="section-title">Latest open positions</h2>
                <p class="subtitle">
                    Here you can check the latest jobs listed by our very selected recruiters. Feel free to keep an eye
                    on our platform not to miss your future job.
                </p>
            </div>
            <Projects :skills="skills" :projects="projects"/>
        </div>
    </section>
</template>
