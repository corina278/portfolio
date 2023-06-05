x<script setup>
import {onMounted} from "vue";

defineProps({
    project: Object,
});

</script>


<template>
        <div class="mb-6">
            <img class="rounded-2xl h-56" :src="project.image" :alt="project.name" />
        </div>
    <div class="flex">
            <span v-for="skill in project.skills"
                  class="flex text-accent text-sm mb-3 mr-4"
            >
                {{ skill }}
            </span>
    </div>

    <h3
        class="
        group-hover:text-light-tail-500
        text-2xl
        font-semibold
        capitalize
        mb-3
      "
    >
        {{ project.name }}
    </h3>
</template>
