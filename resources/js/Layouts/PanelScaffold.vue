<template>
    <main :dir="dir()" class="min-h-screen panel   " :class="{'dark':isDark}">
        <Head>
            <slot name="header"/>
        </Head>
        <Alert v-show="$page.props.flash.status" ref="alert"/>

        <Toast ref="toast"/>
        <div class="  flex h-screen antialiased text-gray-900 bg-gray-100 dark:bg-dark dark:text-light">
            <!-- Loading screen -->
            <div v-if="loading"
                 class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-primary-darker hidden">
                Loading.....
            </div>


            <!-- Sidebar -->
            <aside class="  overflow-x-hidden  ">
                <slot name="sidenav"></slot>
            </aside>
            <!--Panel Main Side-->
            <div id="content" class="flex-1 h-full overflow-x-hidden overflow-y-auto">
                <!-- Navbar -->
                <header class="relative bg-white dark:bg-darker">
                    <div class="flex items-center justify-between p-2 border-b dark:border-primary-darker">
                        <!--   Sidenav toggle button -->
                        <button data-te-sidenav-toggle-ref data-te-target="#sidenav-1"
                                class="block border-0 bg-transparent px-2.5 text-gray-500 hover:no-underline hover:shadow-none focus:no-underline focus:shadow-none focus:outline-none focus:ring-0 "
                                aria-controls="#sidenav-1" aria-haspopup="true" aria-expanded="false">

                <span>
            <Bars3Icon class=" w-7 text-primary-500"/>

                </span>
                        </button>

                        <!-- Brand -->
                        <Link :href="route('/')"
                              class="inline-block text-2xl font-bold tracking-wider   text-primary-500 dark:text-light">
                            {{ __('app_name') }}
                        </Link>


                        <!-- Left   buttons -->
                        <nav aria-label="Secondary" class="p-1    flex  items-center">
                            <!-- Toggle dark theme button -->
                            <button v-if="false" aria-hidden="true" class="relative focus:outline-none"
                                    @click="isDark=!isDark">
                                <div
                                    class="w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-lighter"></div>
                                <div
                                    class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-150 transform scale-110 rounded-full shadow-sm translate-x-0 -translate-y-px bg-white text-primary-dark"
                                    :class="{ 'translate-x-0 -translate-y-px  bg-white text-primary-dark': !isDark, 'translate-x-6 text-primary-100 bg-primary-darker': isDark }">
                                    <svg v-show="!isDark" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                                    </svg>
                                    <svg v-show="isDark" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                    </svg>
                                </div>
                            </button>

                            <!-- Notification button -->
                            <div class="relative mx-1" data-te-dropdown-ref>
                                <button
                                    class="flex p-2 items-center whitespace-nowrap rounded bg-primary  rounded-full text-primary-500 bg-primary-50 hover:text-primary hover:bg-primary-100    text-xs font-medium   leading-normal     transition duration-150 ease-in-out   hover:shadow-lg focus:bg-primary-200 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-200 active:shadow-lg motion-reduce:transition-none dark:shadow-lg dark:hover:shadow-lg dark:focus:shadow-lg"
                                    type="button"
                                    id="dropdownNotidicationSetting"
                                    data-te-dropdown-toggle-ref
                                    aria-expanded="false"
                                    data-te-ripple-init
                                    data-te-ripple-color="light">
                                    <span class="sr-only">Open notidications panel</span>
                                    <span v-if="$page.props.auth.user.notifications>0"
                                          class="bg-red-500 rounded-full text-white px-[.3rem] absolute top-0 start-0  ">
                                    {{ $page.props.auth.user.notifications }}
                                </span>
                                    <BellAlertIcon class="w-7 h-7"/>
                                </button>
                                <ul
                                    class="absolute z-[1000] float-start m-0 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-start text-base shadow-lg dark:bg-neutral-700 [&[data-te-dropdown-show]]:block"
                                    aria-labelledby="dropdownNotidicationSetting"
                                    data-te-dropdown-menu-ref>
                                    <li>
                                        <a
                                            class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-neutral-600"
                                            href="#"
                                            data-te-dropdown-item-ref
                                        >Action</a
                                        >
                                    </li>


                                </ul>
                            </div>


                            <!-- Settings button -->
                            <div class="relative mx-1" data-te-dropdown-ref>
                                <button
                                    class="flex p-2 items-center whitespace-nowrap rounded bg-primary  rounded-full text-primary-500 bg-primary-50 hover:text-primary hover:bg-primary-100    text-xs font-medium   leading-normal     transition duration-150 ease-in-out   hover:shadow-lg focus:bg-primary-200 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-200 active:shadow-lg motion-reduce:transition-none dark:shadow-lg dark:hover:shadow-lg dark:focus:shadow-lg"
                                    type="button"
                                    id="dropdownMenuSetting"
                                    data-te-dropdown-toggle-ref
                                    aria-expanded="false"
                                    data-te-ripple-init
                                    data-te-ripple-color="light">
                                    <span class="sr-only">Open settings panel</span>
                                    <Cog6ToothIcon class="w-7 h-7"/>
                                </button>
                                <ul
                                    class="absolute z-[1000] float-start m-0 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-start text-base shadow-lg dark:bg-neutral-700 [&[data-te-dropdown-show]]:block"
                                    aria-labelledby="dropdownMenuSetting"
                                    data-te-dropdown-menu-ref>
                                    <li>
                                        <a
                                            class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-neutral-600"
                                            href="#"
                                            data-te-dropdown-item-ref
                                        >Action</a
                                        >
                                    </li>


                                </ul>
                            </div>


                            <!-- User avatar button -->

                            <div class="relative mx-1  " data-te-dropdown-ref>
                                <button
                                    id="dropdownUserSetting"
                                    data-te-dropdown-toggle-ref
                                    aria-expanded="false"
                                    data-te-ripple-init
                                    data-te-ripple-color="light"
                                    class=" flex p-2 transition-colors duration-200 rounded-full text-primary-500 bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark focus:outline-none focus:bg-primary-100 dark:focus:bg-primary-dark focus:ring-primary-darker">

                                    <span class="sr-only">User menu</span>
                                    <Image
                                        classes="   hover:shadow-lg  object-cover   rounded-full w-8 h-8  "
                                        src="https://www.kindpng.com/free/profile-picture"
                                        alt="jane avatar"
                                        type="user"/>
                                </button>

                                <!-- User dropdown menu -->
                                <div ref="userMenu" data-te-dropdown-menu-ref
                                     class="min-w-[12rem] absolute z-[1000] float-start m-0 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-start text-base shadow-lg dark:bg-neutral-700 [&[data-te-dropdown-show]]:block"
                                     tabindex="-1" role="menu" aria-orientation="vertical" aria-label="User menu"

                                     aria-labelledby="dropdownUserSetting">
                                    <Link href="#" role="menuitem"
                                          class="  block  p-4 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary">
                                        {{ __('profile_setting') }}
                                    </Link>
                                    <hr class="border-gray-200 dark:border-gray-700 ">
                                    <a href="#" role="menuitem"
                                       class="block p-4 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary">
                                        {{ __('change_password') }}
                                    </a>
                                    <hr class="border-gray-200 dark:border-gray-700 ">
                                    <Link :href="route('logout')" class="flex ">
                                        <button class="flex items-center justify-center p-4 m-3  w-full  hover:scale-110 focus:outline-none     px-4 py-2 rounded font-bold cursor-pointer
        hover:bg-red-700 hover:text-red-100  bg-red-100 text-red-500  border duration-200 ease-in-out border-red-600  ">
                                            {{ __('signout') }}
                                            <ArrowRightOnRectangleIcon class="h-5 w-5 text-red-500  "/>
                                        </button>
                                    </Link>
                                </div>
                            </div>
                        </nav>

                    </div>

                </header>

                <!-- Main content -->
                <main class="min-h-screen text-primary-500">
                    <!--   content-->
                    <slot name="content" :showToast="showToast"/>
                </main>

                <!-- Main footer -->
                <footer
                    class="flex shadow-lg drop-shadow items-center justify-between p-4 bg-white   dark:bg-darker dark:border-primary-darker">
                    <div>
                        <a href="https://zil.ink/varta" target="_blank" class="text-blue-500 hover:underline">
                        </a>
                    </div>
                    <div> {{ __('app_name') }} {{ (new Date()).toLocaleDateString('GMT', {year: 'numeric',}) }}</div>
                </footer>
            </div>


        </div>
    </main>
</template>

<script>
import {Head, Link} from '@inertiajs/vue3';
import Navbar from "@/Components/Navbar.vue";
import Footer from "@/Components/Footer.vue";
import Toast from "@/Components/Toast.vue";
import Image from '@/Components/Image.vue';
import {
    Bars3Icon,
    BellAlertIcon,
    Cog6ToothIcon,
    ArrowRightOnRectangleIcon,
} from "@heroicons/vue/24/outline";
import {Dropdown, initTE, Sidenav} from "tw-elements";
import {provide, onMounted, getCurrentInstance} from "vue";
import {router} from '@inertiajs/vue3'
import mitt from 'mitt'
import Alert from "@/Components/Alert.vue";

export const emitter = mitt()
let self;

export default {
    components: {
        Alert,
        Head, Link, Navbar, Footer, Toast, Bars3Icon, BellAlertIcon, Cog6ToothIcon, Image, ArrowRightOnRectangleIcon
    },

    created() {
    },
    data() {
        return {
            isDark: false,
            loading: false,
            toast: null,
        }
    },
    mounted() {
        window.tailwindElements();

        initTE({Sidenav});


        let innerWidth = null;

        const setMode = (e) => {
            // Check necessary for Android devices
            if (window.innerWidth === innerWidth) {
                return;
            }

            innerWidth = window.innerWidth;

            if (window.innerWidth < window.Sidenav.getBreakpoint("md")) {
                window.Sidenav.changeMode("over");
                window.Sidenav.hide();
            } else {
                window.Sidenav.changeMode("side");
                window.Sidenav.show();
            }
        };

        if (window.innerWidth < window.Sidenav.getBreakpoint("md")) {
            setMode();
        }

        window.addEventListener("resize", setMode);
        self = this;

        this.emitter.on('showToast', (e) => {
            this.$refs.toast.show(e.type, e.message);
        });

        this.emitter.on('showAlert', (e) => {
            if (this.$refs.alert)
                this.$refs.alert.show(e.type, e.message);
        });

    },

    methods: {},

}
</script>
