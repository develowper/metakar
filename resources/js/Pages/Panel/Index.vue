<template>

    <Panel>
        <template v-slot:header>
            <title>{{__('panel')}}</title>
        </template>


        <template v-slot:content>
            <!-- Content header -->
            <div
                class="flex items-center justify-between px-4 py-2 border-b lg:py-4 dark:border-primary-darker">
                <h1 class="text-2xl font-semibold">{{ __('statistics') }}</h1>

            </div>

            <!-- Content -->
            <div class="mt-2">
                <!-- State cards -->
                <div class="grid grid-cols-1 gap-8 p-4 lg:grid-cols-2 xl:grid-cols-4">
                    <!-- wallet card -->
                    <div class="flex shadow-sm items-center justify-between p-4 bg-white  rounded-lg dark:bg-darker">
                        <div>
                            <h6 class="text-xs font-medium  py-2 tracking-wider text-gray-500 uppercase dark:text-primary-light">
                                {{ __('wallet') }}
                            </h6>
                            <span class="text-xl font-semibold"> {{ asPrice(user.wallet) }} {{ __('currency') }}</span>

                        </div>

                        <div>
                            <CurrencyDollarIcon class="w-12 h-12 text-primary-300 dark:text-pink-50 "/>
                        </div>

                    </div>

                    <!-- Users card -->
                    <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
                        <div>
                            <h6 class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light">
                                Users
                            </h6>
                            <span class="text-xl font-semibold">50,021</span>
                            <span
                                class="inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md">
                      +2.6%
                    </span>
                        </div>
                        <div>
                    <span>
                      <svg class="w-12 h-12 text-gray-300 dark:text-primary-dark" xmlns="http://www.w3.org/2000/svg"
                           fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                      </svg>
                    </span>
                        </div>
                    </div>

                    <!-- Orders card -->
                    <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
                        <div>
                            <h6 class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light">
                                Orders
                            </h6>
                            <span class="text-xl font-semibold">45,021</span>
                            <span
                                class="inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md">
                      +3.1%
                    </span>
                        </div>
                        <div>
                    <span>
                      <svg class="w-12 h-12 text-gray-300 dark:text-primary-dark" xmlns="http://www.w3.org/2000/svg"
                           fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                      </svg>
                    </span>
                        </div>
                    </div>

                    <!-- Tickets card -->
                    <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
                        <div>
                            <h6 class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light">
                                Tickets
                            </h6>
                            <span class="text-xl font-semibold">20,516</span>
                            <span
                                class="inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md">
                      +3.1%
                    </span>
                        </div>
                        <div>
                    <span>
                      <svg class="w-12 h-12 text-gray-300 dark:text-primary-dark" xmlns="http://www.w3.org/2000/svg"
                           fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                      </svg>
                    </span>
                        </div>
                    </div>
                </div>

                <!-- Charts -->
                <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3">
                    <!-- Bar chart card -->
                    <div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                        <!-- Card header -->
                        <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                            <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Bar Chart</h4>
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-500 dark:text-light">Last year</span>
                                <button class="relative focus:outline-none"
                                        @click="isOn = !isOn;  ">
                                    <div
                                        class="w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-darker"></div>
                                    <div
                                        class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-200 ease-in-out transform scale-110 rounded-full shadow-sm translate-x-0 bg-white dark:bg-primary-100"
                                        :class="{ 'translate-x-0  bg-white dark:bg-primary-100': !isOn, 'translate-x-6 bg-primary-light dark:bg-primary': isOn }"></div>
                                </button>
                            </div>
                        </div>
                        <!-- Chart -->
                        <div class="relative p-4 h-72">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="barChart" style="display: block; width: 505px; height: 256px;"
                                    width="505" height="256" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>

                    <!-- Doughnut chart card -->
                    <div class="bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                        <!-- Card header -->
                        <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                            <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Doughnut Chart</h4>
                            <div class="flex items-center">
                                <button class="relative focus:outline-none"
                                        @click="isOn = !isOn; $parent.updateDoughnutChart(isOn)">
                                    <div
                                        class="w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-darker"></div>
                                    <div
                                        class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-200 ease-in-out transform scale-110 rounded-full shadow-sm translate-x-0 bg-white dark:bg-primary-100"
                                        :class="{ 'translate-x-0  bg-white dark:bg-primary-100': !isOn, 'translate-x-6 bg-primary-light dark:bg-primary': isOn }"></div>
                                </button>
                            </div>
                        </div>
                        <!-- Chart -->
                        <div class="relative p-4 h-72">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="doughnutChart" width="505" height="256"
                                    style="display: block; width: 505px; height: 256px;"
                                    class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Two grid columns -->
                <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3">
                    <!-- Active users chart -->
                    <div class="col-span-1 bg-white rounded-md dark:bg-darker">
                        <!-- Card header -->
                        <div class="p-4 border-b dark:border-primary">
                            <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Active users right
                                now</h4>
                        </div>
                        <p class="p-4">
                                    <span class="text-2xl font-medium text-gray-500 dark:text-light"
                                          id="usersCount">104</span>
                            <span class="text-sm font-medium text-gray-500 dark:text-primary">Users</span>
                        </p>
                        <!-- Chart -->
                        <div class="relative p-4">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="activeUsersChart" width="505" height="150"
                                    style="display: block; width: 505px; height: 150px;"
                                    class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>

                    <!-- Line chart card -->
                    <div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                        <!-- Card header -->
                        <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                            <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Line Chart</h4>
                            <div class="flex items-center">
                                <button class="relative focus:outline-none"
                                        @click="isOn = !isOn; $parent.updateLineChart()">
                                    <div
                                        class="w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-darker"></div>
                                    <div
                                        class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-200 ease-in-out transform scale-110 rounded-full shadow-sm translate-x-0 bg-white dark:bg-primary-100"
                                        :class="{ 'translate-x-0  bg-white dark:bg-primary-100': !isOn, 'translate-x-6 bg-primary-light dark:bg-primary': isOn }"></div>
                                </button>
                            </div>
                        </div>
                        <!-- Chart -->
                        <div class="relative p-4 h-72">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="lineChart" width="505" height="256"
                                    style="display: block; width: 505px; height: 256px;"
                                    class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </template>


    </Panel>
</template>

<script>
import Scaffold from "@/Layouts/Scaffold.vue";
import Panel from "@/Layouts/Panel.vue";
import {Head, Link} from "@inertiajs/vue3";
import {loadScript} from "vue-plugin-load-script";

import {
    HomeIcon,
    ChevronDownIcon,
    Bars3Icon,
    PlusSmallIcon,
    Bars2Icon,
    NewspaperIcon,
    WindowIcon,
    GlobeAltIcon,
    PencilSquareIcon,
    PhotoIcon,
    FilmIcon,
    MicrophoneIcon,
    MegaphoneIcon,
    LightBulbIcon,
    CurrencyDollarIcon,
    BellAlertIcon,
    Cog6ToothIcon,
    TicketIcon,
} from "@heroicons/vue/24/outline";

export default {
    data() {
        return {
            open: false,
            isDark: false,
            loading: false,
            showDialog: false,
            isMobileMainMenuOpen: false,
            isMobileSubMenuOpen: false,
            isOn: false,
            user: this.$page.props.auth.user
        }
    },
    components: {Panel, Scaffold, CurrencyDollarIcon,  TicketIcon,},
    mounted() {

    }

}
</script>
q
