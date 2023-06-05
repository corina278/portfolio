<script setup>
import Project from "@/Components/Sections/Project.vue";

defineProps({
    projects: Object,
    skills: Object
})
</script>

<script>
import { defineComponent } from 'vue'
import { Carousel, Pagination, Slide } from 'vue3-carousel'

import 'vue3-carousel/dist/carousel.css'
export default defineComponent({
    name: 'Autoplay',
    components: {
        Carousel,
        Slide,
        Pagination,
    },
    // methods: {
    //     getsKillUrl(skill) {
    //         return 'projects?skill=' + skill;
    //     }
    // }
})
// export default defineComponent({
//     name: 'Autoplay',
//     components: {
//         Carousel,
//         Slide,
//         Pagination,
//     },
// })
</script>

<template>
    <div class="container mx-auto">
        <Carousel :itemsToShow="3.95" :wrapAround="true" :transition="500">
            <Slide v-for="projectSkill in skills.data" :key="projectSkill.id">
                <div class="carousel__item">{{ projectSkill.name }}</div>
            </Slide>
<!--                <nav class="mb-12 border-b-2 border-light-tail-100 dark:text-dark-navy-100 overflow-auto">-->
<!--                    <ul class="flex flex-col lg:flex-row justify-evenly items-center">-->
<!--                        <li class="cursor-pointer capitalize m-4">-->
<!--                            <button class="flex text-center px-4 py-2 hover:text-light-tail-500 dark:text-dark-navy-100">All</button>-->
<!--                        </li>-->
<!--                        <li class="cursor-pointer capitalize m-4" v-for="projectSkill in skills.data" :key="projectSkill.id">-->
<!--                            <a class="flex text-center px-4 py-2 hover:text-light-tail-500 dark:text-dark-navy-100"-->
<!--                            :href="getsKillUrl(projectSkill.name)">{{ projectSkill.name }}</a>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </nav>-->
        </Carousel>
        <section class="grid gap-y-12 lg:grid-cols-3 lg:gap-8">
            <Project v-for="project in projects" :key="project.id" :project="project" />
        </section>
    </div>
</template>


<style scoped>
.carousel__slide {
    padding: 5px;
    margin-bottom: 50px;
    background-color: floralwhite;
    border: solid #f18a8a;
    border-radius: 20px;
}

.carousel__viewport {
    perspective: 2000px;
}

.carousel__track {
    transform-style: preserve-3d;
}

.carousel__slide--sliding {
    transition: 0.5s;
}

.carousel__slide {
    opacity: 0.9;
    transform: rotateY(-20deg) scale(0.75);
}

/*.carousel__slide--active ~ .carousel__slide {*/
/*    transform: rotateY(20deg) scale(0.9);*/
/*    margin-left: 25px;*/
/*}*/

.carousel__slide--prev {
    opacity: 1;
    transform: rotateY(-10deg) scale(0.75);
}

.carousel__slide--next {
    opacity: 1;
    transform: rotateY(10deg) scale(0.75);
}

.carousel__slide--active {
    opacity: 1;
    transform: rotateY(0) scale(1);
}
</style>
