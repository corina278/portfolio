<template>
    <header class="bg-light-primary header">
        <nav class="bg-light-primary mx-auto flex fixed items-center justify-between p-2  w-full sm:px-4 rounded"
                :class="{
            'bg-light-primary dark:bg-dark-primary': scrollBg,
            'bg-white dark:bg-slate-800': !scrollBg,
            } " aria-label="Global">
                <div class="container flex flex-wrap justify-between items-center mx-auto lg:flex-1">
                    <Link class="flex items-center" :href="route('welcome')">
                        <img style="height: 70px" class=" mr-3 sm:h-9" src="http://portfolio.test/img/InTouch.png" alt="" />
                        <h1 class="text-l">InTouch</h1>
                    </Link>
                    </div>
                    <div class="flex lg:hidden">
                        <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-3xl p-2.5 text-gray-700" @click="mobileMenuOpen = true">
                            <span class="sr-only">Open main menu</span>
                            <Bars3Icon class="h-6 w-6" aria-hidden="true" />
                        </button>
                    </div>
                    <PopoverGroup class="hidden lg:flex lg:gap-x-12">
                        <Popover v-if="!hideSections" class="relative">
                            <PopoverButton class="flex items-center gap-x-1 text-sm font-semibold leading-6 text-gray-900">
                                Sections
                                <ChevronDownIcon class="h-5 w-5 flex-none text-gray-400" aria-hidden="true" />
                            </PopoverButton>

                            <transition enter-active-class="transition ease-out duration-200" enter-from-class="opacity-0 translate-y-1" enter-to-class="opacity-100 translate-y-0" leave-active-class="transition ease-in duration-150" leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 translate-y-1">
                                <PopoverPanel class="absolute -left-8 top-full z-10 mt-3 w-screen max-w-md overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-gray-900/5">
                                    <div class="p-4">
                                        <div v-for="(navigations, index) in navigations" :key="index" class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm leading-6 hover:bg-gray-50">
                                            <div class="flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                                <component :is="navigations.icon" class="h-6 w-6 text-gray-600 group-hover:text-indigo-600" aria-hidden="true" />
                                            </div>
                                            <div class="flex-auto"><a :href="navigations.href" class="block font-semibold text-gray-900">
                                                    {{ navigations.name }}
                                                    <span class="absolute inset-0" />
                                                </a>
                                                <p class="mt-1 text-gray-600">{{ navigations.description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </PopoverPanel>
                            </transition>
                        </Popover>
                        <Link :href="route('applications-jobs')" class="text-sm font-semibold leading-6 text-gray-900"> Apply for jobs </Link>
                        <Link v-if="$page.props.auth.user?.is_recruiter" :href="route('skills.index')" class="text-sm font-semibold leading-6 text-gray-900"> Skills </Link>
                        <Link v-if="$page.props.auth.user?.is_recruiter" :href="route('projects.index')" class="text-sm font-semibold leading-6 text-gray-900"> Projects </Link>
                        <Link v-if="$page.props.auth.user?.is_recruiter" :href="route('applications.index')" class="text-sm font-semibold leading-6 text-gray-900"> Applications </Link>
                        <Popover class="relative">
                            <PopoverButton v-if="$page.props.auth.user?.is_recruiter" class="flex items-center gap-x-1 text-sm font-semibold leading-6 text-gray-900">
                                Reports
                                <ChevronDownIcon class="h-5 w-5 flex-none text-gray-400" aria-hidden="true" />
                            </PopoverButton>

                            <transition enter-active-class="transition ease-out duration-200" enter-from-class="opacity-0 translate-y-1" enter-to-class="opacity-100 translate-y-0" leave-active-class="transition ease-in duration-150" leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 translate-y-1">
                                <PopoverPanel class="absolute -left-8 top-full z-10 mt-3 w-screen max-w-md overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-gray-900/5">
                                    <div class="p-4">
                                        <div v-for="(reports, index) in reports" :key="index" class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm leading-6 hover:bg-gray-50">
<!--                                            <div class="flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">-->
<!--                                                <component :is="reports.icon" class="h-6 w-6 text-gray-600 group-hover:text-indigo-600" aria-hidden="true" />-->
<!--                                            </div>-->
                                            <div class="flex-auto"><a :href="reports.path" class="block font-semibold text-gray-900">
                                                {{ reports.name }}
                                                <span class="absolute inset-0" />
                                            </a>
                                            </div>
                                        </div>
                                    </div>
                                </PopoverPanel>
                            </transition>
                        </Popover>
                        <Popover v-if="!hideSections && $page.props.auth.user" class="relative">
                            <PopoverButton class="flex items-center gap-x-1 text-sm font-semibold leading-6 text-gray-900">
                                {{ $page.props.auth.user.name }}
                            <ChevronDownIcon class="h-5 w-5 flex-none text-gray-400" aria-hidden="true" />
                            </PopoverButton>
                            <transition enter-active-class="transition ease-out duration-200" enter-from-class="opacity-0 translate-y-1" enter-to-class="opacity-100 translate-y-0" leave-active-class="transition ease-in duration-150" leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 translate-y-1">
                                <PopoverPanel class="absolute -left-8 top-full z-10 mt-3 w-screen max-w-md overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-gray-900/5">
                                    <div class="p-4">
                                        <div class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm leading-6 hover:bg-gray-50">
                                            <div class="flex-auto">
                                            <a :href="route('profile.edit')" class="block font-semibold text-gray-900">
                                                Profile
                                                <span class="absolute inset-0" />
                                            </a>
                                            </div>
                                        </div>
                                        <div class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm leading-6 hover:bg-gray-50">
                                            <div class="flex-auto">
                                                <button @click="logout" class="block font-semibold text-gray-900">
                                                    Log Out
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </PopoverPanel>
                            </transition>
                        </Popover>
                        <a v-if="!$page.props.auth.user" :href="route('login')" class="text-sm font-semibold leading-6 text-gray-900">Login</a>
                    </PopoverGroup>

                    <div class="hidden lg:flex lg:flex-1 lg:justify-end"></div>
                </nav>
            </header>
        </template>

<script setup>
    import { ref, onMounted } from 'vue'
    import {
        Dialog,
        DialogPanel,
        Disclosure,
        DisclosureButton,
        DisclosurePanel,
        Popover,
        PopoverButton,
        PopoverGroup,
        PopoverPanel,
    } from '@headlessui/vue'
    import {
        Bars3Icon,
        ChartPieIcon,
        XMarkIcon,
    } from '@heroicons/vue/24/outline'
    import {ChevronDownIcon, FolderOpenIcon, PhoneIcon, PlayCircleIcon} from '@heroicons/vue/20/solid'
    import {
        ChatBubbleBottomCenterIcon,
        ChatBubbleBottomCenterTextIcon, HomeIcon, InformationCircleIcon,
        ServerStackIcon
    } from "@heroicons/vue/24/solid";
    import Applications from "@/Components/Frontend/Applications.vue";
    import {router, Link} from "@inertiajs/vue3";
    import DropdownLink from "@/Components/DropdownLink.vue";

    const props = defineProps({
        hideSections: false,
    })

    const mobileMenuOpen = ref(false)
    const scrollBg = ref(false);

    const navigations = [
        { name: "Home", href: "#home", description: 'Get a better understanding of your traffic', icon: HomeIcon },
        { name: "About", href: "#about",description: "Get to know us", icon: InformationCircleIcon },
        { name: "Portfolio", href: "#portfolio", description: "Check out our work", icon:FolderOpenIcon },
        { name: "Services", href: "#services", description:"Here is what we can help you with", icon: ServerStackIcon },
        { name: "Contact", href: "#contact" , description: "Don't hesitate to contact us", icon: ChatBubbleBottomCenterTextIcon},
    ];
    const reports = [
        { name: "Skills Report", path: '/skills-report'},
        { name: "Projects Report", path: '/projects-report'},
        { name: "Applications Report", path: '/applications-report'},
    ]
    const setScrollBg = (value) => {
        scrollBg.value = value;
    };

    const logout = () => {
        router.post(route('logout'));
    }

    onMounted(() => {
        window.addEventListener("scroll", () => {
            return window.scrollY > 50 ? setScrollBg(true) : setScrollBg(false);
        });
    });
</script>

<script>
    export default {
        data() {
            return {
                showApplications: {type: Boolean, default: false},
                // hideSections: false
            }
        }
    }
</script>

<style>
    .header {
        z-index: 100;
        position: relative;
    }
</style>
