<script>
import Header from "@/Components/Frontend/Header.vue";
import Footer from "@/Components/Frontend/Footer.vue";
import Applications from "@/Components/Frontend/Applications.vue";
import ContactMe from "@/Components/Sections/ContactMe.vue";
import Hero from "@/Components/Sections/Hero.vue";
import Portofolio from "@/Components/Sections/Portofolio.vue";
import Promote from "@/Components/Sections/Promote.vue";
import Skills from "@/Components/Sections/Skills.vue";
import Services from "@/Components/Sections/Services.vue";
import About from "@/Components/Sections/About.vue";
// import Login from "@/Components/Pages/Auth/Login.vue";

export default {
    components: {About, Services, Skills, Promote, Portofolio, Hero, ContactMe, Header, Applications, Footer},
    props: {
        skills: Object,
        projects: Object,
    },
    data() {
        return {
            showApplications: false,
            showHero: false,
            showPromote: false,
            showAbout: false,
            showSkills: false,
            showPortofolio: false,
            showServices: false,
            showContactMe: false,
        }
    },
    methods: {

    }
}
</script>
<template>
    <div class="bg-slate-200 dark:bg-slate-900">
        <!-- Header -->
        <Header
            @showApplications="showApplications = true"
            @hideApplications="showApplications = false"
            @hideSections="showApplications = false"
        />
        <Applications v-if="showApplications"
                      @hideApplications="showApplications = false"
                      :skills="skills"
                      :projects="projects"
        />

        <!-- o metoda in care sa verific daca userul e logat? -->

        <!--        Hero primary -->
        <Hero v-if="!showApplications"/>
        <!--        Promote tail-100 -->
        <Promote v-if="!showApplications"/>
        <!--        About secondary  -->
        <About v-if="!showApplications"/>
        <!--        Skills tail-100  -->
        <Skills v-if="!showApplications" :skills="skills"/>
        <!--        Portofolio primary  -->
        <Portofolio v-if="!showApplications" :skills="skills" :projects="projects"/>
        <!--        Services secondary  -->
        <Services v-if="!showApplications"/>
        <!--        Contact primary  -->
        <ContactMe v-if="!showApplications"/>
        <!-- Footer -->
        <Footer />
    </div>
</template>
