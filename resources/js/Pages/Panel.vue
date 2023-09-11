<template>

  <Panel>
    <template v-slot:header>
      <title>{{__('panel')}}</title>
    </template>


    <template #content>
      <!-- Content header -->
      <div
          class="flex items-center justify-between px-4 py-2 border-b lg:py-4 dark:border-primary-darker">
        <h1 class="text-2xl font-semibold">{{ __('statistics') }}</h1>

      </div>

      <!-- Content -->
      <div class="mt-2">
        <!-- State cards -->
        <div class="grid grid-cols-1 gap-8 p-4 lg:grid-cols-2 xl:grid-cols-3">

          <!-- wallet card -->
          <div :class="cardShadow"
               class="flex   items-center justify-between p-4 bg-white  rounded-lg dark:bg-darker ">
            <div>
              <h6 class="text-xs font-bold   py-2 tracking-wider text-gray-500 uppercase dark:text-primary-light">
                {{ __('wallet') }}
              </h6>
              <span class="text-xl font-semibold"> {{ asPrice(user.wallet) }} {{ __('currency') }}</span>

            </div>

            <div>
              <CurrencyDollarIcon class="w-12 h-12 text-primary-300 dark:text-pink-50 "/>
            </div>

          </div>
          <!-- ticket card -->
          <Link :href="route('panel.ticket.index')" :class="cardShadow"
                class="flex hover:scale-[101%] transition duration-300 cursor-pointer   items-center justify-around   p-4 bg-white  rounded-lg dark:bg-darker">
            <div class="flex flex-col grow">
              <h6 class="text-xs font-bold   py-2 tracking-wider text-gray-500 uppercase dark:text-primary-light">
                {{ __('tickets') }}
              </h6>

              <div class="justify-center flex  ">
                                <span v-for="t,idx in tickets" class="align-middle flex  flex-col text-center  ">
                                        <span
                                            :class="idx==0?'text-red-500':idx==1?'text-primary-500':'text-green-500'"
                                            class="  text-xl font-semibold "> {{ t.value }}</span>
                                        <span
                                            :class="idx==0?'bg-red-100 text-red-500':idx==1?'bg-primary-100 text-primary-500':'bg-green-100 text-green-500'"
                                            class="   mx-1 px-2 py-1    text-xs  rounded-md">
                                   {{ __(t.title) }}
                                        </span>
                                </span>
              </div>

            </div>
            <div class="flex">
              <TicketIcon class="w-12 h-12 text-primary-300 dark:text-pink-50 "/>
            </div>

          </Link>


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
import {inject, watchEffect} from "vue";

export default {
  setup(props) {
    // const weatherData = inject('showToast')
    watchEffect(() => {
      // console.log('new weatherData', weatherData.value)
    })
  },
  data() {
    return {
      open: false,
      isDark: false,
      loading: false,
      isMobileMainMenuOpen: false,
      isMobileSubMenuOpen: false,
      isOn: false,
      user: this.$page.props.auth.user,
      tickets: this.$page.props.tickets,
      cardShadow: 'shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)]',
    }
  },
  // emits: ['showToast'],
  components: {Panel, CurrencyDollarIcon, TicketIcon, Head, Link},
  mounted() {
    // console.log(this.$emit('showToast'))

    // this.showToast('warning', 'hii');


  },
  methods: {},

}
</script>

