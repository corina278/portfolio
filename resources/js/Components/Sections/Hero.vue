<script setup>
</script>
<template>
    <section id="home" class="lg:h-[85vh] flex items-center bg-light-primary dark:bg-dark-primary py-32 lg:py-0 overflow-hidden">
        <div class="container mx-auto h-full">
            <div class="flex flex-col md:flex-row items-center h-full pt-8">
                <div class="flex-1 flex flex-col items-center lg:items-start">
                    <p class="text-lg text-accent tect-md mb-[22px]">
                        Welcome to InTouch! 🤝
                    </p>
                    <h1 class="text-4xl leading-[44px] md:text-5xl md:leading-[1.2] font-bold md:traking-[-2px]">
                        Job application platform for <br/> Entry-level & junior jobs.
                    </h1>
                    <p class="pt-4 pb-8 md:pt-6 md:pb-12 max-w-[480px] text-lg text-center lg:text-left">
                        Good luck in your career!
                    </p>
                    <a :href="route('login')"
                        class="btn btn-md bg-accent rounded-xl hover:bg-light-secondary md:btn-lg transition-all hover:text-light-tail-500">
                            Let's get started
                    </a>
                </div>
                <div class="flex flex-1 justify-end items-center h-full mt-8 md:mt-0">
                    <img class="rounded-lg" src="http://portfolio.test/img/main.jpeg" alt="Hero"/>
                </div>
            </div>
        </div>
    </section>
</template>
