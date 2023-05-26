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
import SkillsIndex from "@/Pages/Skills/index.vue";
import ProjectsIndex from "@/Pages/Projects/index.vue";
import ApplicationsIndex from "@/Pages/Applications/index.vue";

export default {
    components: {SkillsIndex, ProjectsIndex, ApplicationsIndex, About, Services, Skills, Promote, Portofolio, Hero, ContactMe, Header, Applications, Footer},
    props: {
        skills: Object,
        projects: Object,
        applications: Object,
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
            showSkillsIndex: false,
            showProjectsIndex: false,
            showApplicationsIndex: false
        }
    },
    methods: {

    }
}
</script>
<template>
    <div class="bg-slate-200 dark:bg-slate-900">
        <Header
            @showApplications="showApplications = true"
            @hideApplications="showApplications = false"
        />
<!--        <SkillsIndex v-if="showSkillsIndex"-->
<!--                     :skills="skills"-->
<!--        />-->
<!--        <ProjectsIndex v-if="showProjectsIndex"-->
<!--                     @hideProjectsIndex="showProjectsIndex=false"-->
<!--                     :projects="projects"-->
<!--        />-->
<!--        <ApplicationsIndex v-if="   showApplicationsIndex"-->
<!--                     @hideApplicationsIndex="showApplicationsIndex=false"-->
<!--                     :applications="applications"-->
<!--        />-->
<!--        <Applications v-if="showApplications"-->
<!--                      @hideApplications="showApplications = false"-->
<!--                      :skills="skills"-->
<!--                      :projects="projects"-->
<!--        />-->

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
