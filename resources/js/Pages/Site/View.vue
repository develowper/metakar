<template>
  <Scaffold>
    <template v-slot:header>
      <title>{{__('sites')}}</title>
    </template>
    <div class="relative bg-gradient-to-t from-pink-300 via-purple-300 to-indigo-400">
      <!--Hero-->
      <div class="py-12 lg:py-24 mx-auto    ">
        <div class="  px-3  sm:px-1  flex   flex-col md:flex-row items-center ">
          <!--                    Right Col-->
          <!--          <div class="  md:w-2/5 py-6 text-center">-->
          <!--            <img class="w-full xs:w-3/4 sm:w-3/4   mx-auto  z-50   " :src="heroImage"/>-->
          <!--          </div>-->
          <!--Left Col-->
          <div
              class="flex flex-col max-w-3xl text-white w-full   justify-center  mx-auto  text-center ">
            <h1 class="my-4 text-5xl font-bold leading-tight">

            </h1>
            <p class="leading-normal text-2xl mb-8">

            </p>
            <!--                        search-->
            <div v-if="false" class="w-full mx-auto mt-2 my-10">
              <div class="relative  px-6 mx-auto  ">
                <div
                    class="absolute top-0 bottom-0 start-0 flex items-center opacity-60  ps-10  ">
                  <svg
                      class="w-4 h-4 text-gray-600 fill-current   "
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20">
                    <path
                        d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
                  </svg>
                  <span class="absolute border-gray-300  border-s top-0 bottom-0 my-2 ms-6"></span>
                </div>
                <input id="search-toggle" type="search" :placeholder="__('hero_search_placeholder')"
                       class="placeholder-gray-400 border-transparent block w-full py-3 ps-12 pe-4 font-bold text-gray-700 bg-gray-100 rounded-lg shadow-lg focus:outline-none focus:bg-white"
                       onkeyup="updateSearchResults(this.value);">

              </div>


            </div>
            <div class="  px-3    flex  items-center">
            </div>
          </div>

        </div>
      </div>
      <!--wave-->
      <div class="absolute  bottom-0 start-0 end-0">
        <svg viewBox="0 0 1428 174" xmlns="http://www.w3.org/2000/svg"
             xmlns:xlink="http://www.w3.org/1999/xlink">
          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g transform="translate(-2.000000, 44.000000)" fill="#FFFFFF" fill-rule="nonzero">
              <path
                  d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496"
                  opacity="0.100000001"></path>
              <path
                  d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z"
                  opacity="0.100000001"
              ></path>
              <path
                  d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z"
                  id="Path-4" opacity="0.200000003"></path>
            </g>
            <g transform="translate(-4.000000, 76.000000)" fill="#FFFFFF" fill-rule="nonzero">
              <path
                  d="M0.457,34.035 C57.086,53.198 98.208,65.809 123.822,71.865 C181.454,85.495 234.295,90.29 272.033,93.459 C311.355,96.759 396.635,95.801 461.025,91.663 C486.76,90.01 518.727,86.372 556.926,80.752 C595.747,74.596 622.372,70.008 636.799,66.991 C663.913,61.324 712.501,49.503 727.605,46.128 C780.47,34.317 818.839,22.532 856.324,15.904 C922.689,4.169 955.676,2.522 1011.185,0.432 C1060.705,1.477 1097.39,3.129 1121.236,5.387 C1161.703,9.219 1208.621,17.821 1235.4,22.304 C1285.855,30.748 1354.351,47.432 1440.886,72.354 L1441.191,104.352 L1.121,104.031 L0.457,34.035 Z"
              ></path>
            </g>
          </g>
        </svg>
      </div>

    </div>
    <div
        class="   rounded-lg overflow-x-hidden shadow-lg max-w-4xl  xs:mx-2 md:mx-auto    blur-xs opacity-75 bg-white  backdrop-filter">
      <div v-if="$page.props.error_message" class="text-center flex flex-col font-bold p-4 text-danger  text-lg">
        <div class="text-gray-900">{{ $page.props.error_message }}</div>
        <Link :href="$page.props.error_link" class="my-4">{{ __('return') }}</Link>
      </div>
      <!--      main sectiob-->

      <div v-else-if="data" class=" flex flex-col ">
        <div class="px-4 py-2 text-white bg-primary">{{ data.name }}</div>
        <div class="block xs:flex items-center justify-between     text-white bg-primary px-4 py-2 ">

          <div
              class=" flex w-full justify-start  items-center  text-sm  ">
            <div class="flex items-center">
              <EyeIcon class="w-4 h-4"/>
              <span class="px-1">{{ __('view') }}:</span>
              <span class="px-1">{{ data.views }}</span>
            </div>
            <div class=" border-s   py-4 md:mx-6  mx-1"></div>
            <div v-if="!hasWallet()" class="flex items-center">
              <CurrencyDollarIcon class="w-4 h-4"/>

              <span class="px-1">{{ __('reward') }}:</span>
              <span class="px-1">{{ $page.props.site_view_meta_reward }} {{ __('meta') }}</span>
            </div>
            <div v-else class="flex items-center">
              <CurrencyDollarIcon class="w-4 h-4"/>
              <span class="px-1">{{ __('reward') }}:</span>
              <span class="px-1">{{ asPrice(data.view_fee) }} {{ __('currency_symbol') }}</span>
            </div>
            <div class=" border-s   py-4 md:mx-6  mx-1"></div>
            <div class="flex items-center" dir="ltr">
              <input v-model="auto_view"
                     @change="auto_view && timer>=$page.props.reward_second  ?startTimer($refs.iframe  ):null"
                     class="mx-2   h-3.5 w-8 appearance-none rounded-[0.4375rem]  bg-neutral-300 before:pointer-events-none before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-[''] after:absolute after:z-[2] after:-mt-[0.1975rem] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-neutral-100 after:shadow-[0_0px_3px_0_rgb(0_0_0_/_7%),_0_2px_2px_0_rgb(0_0_0_/_4%)] after:transition-[background-color_0.2s,transform_0.2s] after:content-[''] checked:bg-success checked:after:absolute checked:after:z-[2] checked:after:-mt-[3px] checked:after:ml-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:bg-success checked:after:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-[''] hover:cursor-pointer focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[3px_-1px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:border-success checked:focus:bg-success checked:focus:before:ml-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:bg-neutral-600 dark:after:bg-success-400 dark:checked:bg-primary dark:checked:after:bg-success dark:focus:before:shadow-[3px_-1px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca]"
                     type="checkbox"
                     role="switch"
                     id="auto_view"
              />
              <label
                  class="inline-block px-2 hover:cursor-pointer"
                  for="auto_view"
              > {{ __('auto_view') }}</label
              >
            </div>
          </div>
          <div class="text-primary-500 bg-primary-100 rounded-lg p-2 flex text-xs">
            <span class="mx-1">  {{ __('viewable') }}:</span>
            <span class="mx-1"> {{ available_sites > 0 ? available_sites - 1 : 0 }}</span>

          </div>
        </div>
        <div class="flex">
          <div class="shadow w-full bg-grey-light m-2   bg-gray-200 rounded-full">
            <div
                class=" bg-primary rounded  text-xs leading-none py-[.1rem] text-center text-white duration-300 "
                :class="{' animate-pulse': timerPercent<100}"
                :style="`width: ${timerPercent}%`">
              <span class="animate-bounce">{{ timer }}</span>
            </div>
          </div>
        </div>

        <iframe ref="iframe" class="w-full h-screen" :src="$page.props.data.link"
                @load.once="startTimer">

        </iframe>
      </div>
    </div>
  </Scaffold>
</template>

<script>

import Scaffold from "@/Layouts/Scaffold.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {Head, Link} from "@inertiajs/vue3";
import LoadingIcon from "@/Components/LoadingIcon.vue";
import Image from "@/Components/Image.vue";
import {EyeIcon, CurrencyDollarIcon} from "@heroicons/vue/24/outline";

export default {
  data() {
    return {
      html: null,
      timer: 0,
      timerPercent: 0,
      auto_view: this.$page.props.auto_view,
      error: null,
      data: null,
      available_sites: 0,
      hiddenProp: null,

    }
  },
  components: {
    Scaffold,
    Image,
    Link,
    EyeIcon,
    CurrencyDollarIcon,
  },
  created() {
    // this.isLoading(true);
  },
  mounted() {
    //if support hidden method with perfixes?
    this.hiddenProp = this.getHiddenProp();
    if (!this.$page.props.error_message)
      this.isLoading(true);
    this.data = this.$page.props.data;
    this.available_sites = this.$page.props.available_sites;

  },
  methods: {
    startTimer(el) {
      this.isLoading(false);
      this.timer = 0;
      const iframe = el.target;
      let seconds = this.$page.props.reward_second;
      // seconds = 5;
      const intervalId = setInterval(function () {
        if (!this.tabIsVisible()) {
          this.timer++;
          this.timerPercent = Math.floor((this.timer / seconds) * 100)
        }
        if (this.timer >= seconds) {
          clearInterval(intervalId);
          this.addTransaction();
        }
      }.bind(this), 1000);
    },
    addTransaction() {
      this.isLoading(true);
      window.axios.post(route('transaction.site.view'), {
            id: this.$page.props.data.id,
            auto_view: this.auto_view,
          },
      )
          .then((response) => {
            this.isLoading(false);
            if (response.data && response.data.message) {
              this.showToast('success', response.data.message);
              this.sleep(3000).then(() => {
                if (response.data.next && this.auto_view)
                  this.$inertia.visit(route('site', response.data.next), {method: 'get'});

              });
            }

          })

          .catch((error) => {
            this.isLoading(false);
            this.error = this.getErrors(error);
            // console.log(this.error);
            this.showToast('danger', this.error);

            if (error.response && error.response.data) {
              this.sleep(3000).then(() => {
                if (error.response.data.next && this.auto_view)
                  this.$inertia.visit(route('site', error.response.data.next), {method: 'get'});

              });
            }
          })
          .finally(() => {
            // always executed
            this.isLoading(false);
          });
    },
    tabIsVisible() {


      const prop = this.hiddenProp;
      if (!prop) return false;

      return document[prop];
    },
    getHiddenProp() {
      var prefixes = ['webkit', 'moz', 'ms', 'o'];

      // if 'hidden' is natively supported just return it
      if ('hidden' in document) return 'hidden';

      // otherwise loop over all the known prefixes until we find one
      for (var i = 0; i < prefixes.length; i++) {
        if ((prefixes[i] + 'Hidden') in document)
          return prefixes[i] + 'Hidden';
      }

      // otherwise it's not supported
      return null;
    }
  },

}

</script>