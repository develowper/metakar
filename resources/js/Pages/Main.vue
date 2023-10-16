<template>
  <Scaffold>
    <template v-slot:header>
      <title>{{__('home')}}</title>

    </template>

    <div class="relative    bg-gradient-to-t from-pink-300 via-purple-300 to-indigo-400">
      <!--Hero-->
      <img class=" opacity-50  blur-sm h-full z-0 absolute  bottom-2    start-0 w-full   h-full "
           :src="heroImage"/>
      <div class="py-24 md:py-32 xl:py-48   z-10    mx-auto    ">
        <div class="  px-3  sm:px-1  flex   flex-col md:flex-row items-center">
          <!--                    Right Col-->
          <div class=" z-10 md:w-2/5 py-6 text-center">

            <!--            <h1 class="my-4 text-white text-5xl font-bold    ">-->
            <!--              {{ __('app_name') }}-->
            <!--            </h1>-->
          </div>
          <!--Left Col-->
          <div
              class="flex flex-col max-w-lg text-white w-full md:w-3/5 justify-center   text-center  ">
            <p class="leading-normal text-2xl mb-8 z-10">
              {{ heroText }}
            </p>
            <!--                        search-->
            <div v-if="false" class="w-full mx-auto mt-2  ">
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
            <div class=" z-10 p-3    flex  items-center">
              <PrimaryButton @click="$inertia.visit(route('panel.index'))" class="mx-2 p-2 grow">{{
                  __('adv_create')
                }}
              </PrimaryButton>
              <SecondaryButton @click="$inertia.visit(route('page.make_money'))" class="mx-2 p-2 grow">{{
                  __('make_money')
                }}
              </SecondaryButton>
            </div>
          </div>

        </div>
      </div>
      <!--wave-->
      <div class="absolute  bottom-0 start-0 end-0">
        <svg viewBox="0 0 1428 174" version="1.1" xmlns="http://www.w3.org/2000/svg"
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
    <div class="container mx-auto space-y-4">
      <Transition name="fade" mode="out-in">
        <section class="flex flex-col   justify-center   text-center ">
          <h1 class="slide-in-bottom-h1 my-4 text-primary-500 mx-auto w-fit text-3xl font-bold border-primary       ">
            {{ __('our_services') }}
            <div
                class="h-1 mx-auto bg-gradient-to-l from-primary-100 via-primary-500 to-primary-600 w-64 opacity-25 my-0 py-0 rounded-t"></div>

          </h1>
          <div class="  text-primary-500  slide-in-bottom-subtitle ">{{ __('how_help_you_revenue') }}</div>

          <div class="m-4 mt-8 gap-4 grid md:grid-cols-2 lg:grid-cols-4 bounce-top-icons">

            <div v-for="(item,idx) in section1"
                 class="flex gap-4 bg-gradient-to-l from-primary-50 via-gray-50 to-primary-100 shadow-md rounded-lg p-4 py-8 items-stretch">
              <component v-bind:is="item.icon" class="w-12 h-12 lg:w-24 lg:h-24 text-primary-500"></component>
              <div class="flex flex-col justify-start space-y-2 items-start  ">
                <div class="text-sm font-bold">{{ __(item.header) }}</div>
                <p class="text-sm text-start text-primary-900">{{ __(item.sub) }}</p>
              </div>
            </div>


          </div>
        </section>
      </Transition>

      <Transition name="fade" mode="out-in" class=" ">
        <section class="flex flex-col   justify-center   text-center ">
          <h1 class="slide-in-bottom-h1 my-4 text-primary-500 mx-auto w-fit text-3xl font-bold border-primary       ">
            {{ __('until_now') }}
            <div
                class="h-1 mx-auto bg-gradient-to-l from-primary-100 via-primary-500 to-primary-600 w-64 opacity-25 my-0 py-0 rounded-t"></div>
          </h1>

          <div class="  text-primary-500  slide-in-bottom-subtitle ">{{ __('hero_stats') }}</div>

          <div class="m-4 mt-8 gap-4 grid md:grid-cols-4 lg:grid-cols-7 bounce-top-icons">
            <div v-for="(key,idx) in Object.keys(counts)"
                 class="flex flex-col justify-center items-center gap-4 bg-gradient-to-t from-primary-50 via-gray-50 to-primary-100 shadow-md rounded-lg p-4 py-8  ">
              <component v-bind:is="counts[key].icon" class="w-8 h-8 lg:w-12 lg:h-12 text-primary-500"></component>
              <div class="text-sm font-bold">{{ __(key) }}</div>
              <p class="text-lg text-start text-primary-900 countup">{{ __(counts[key].count) }}</p>
            </div>


          </div>
        </section>
      </Transition>
    </div>

  </Scaffold>
</template>

<script>
import Scaffold from "@/Layouts/Scaffold.vue";
import {Head, Link} from '@inertiajs/vue3';
import heroImage from '@/../images/hero.png';
import {loadScript} from "vue-plugin-load-script";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {
  HomeModernIcon,
  RocketLaunchIcon,
  UsersIcon,
  WrenchScrewdriverIcon,
  PencilIcon,
  GlobeAltIcon,
  MicrophoneIcon,
  PlayIcon,
  PhotoIcon,

} from "@heroicons/vue/24/solid";

export default {
  data() {
    return {
      heroImage,
      section1: [
        {header: 'businesses', sub: 'hero_services_1', icon: 'HomeModernIcon'},
        {header: 'sites', sub: 'hero_services_2', icon: 'RocketLaunchIcon'},
        {header: 'regular_users', sub: 'hero_services_3', icon: 'UsersIcon'},
        {header: 'special_users', sub: 'hero_services_4', icon: 'WrenchScrewdriverIcon'},
      ],

      counts: this.$page.props.counts,
    }
  },
  props: ['heroText'],
  components: {
    SecondaryButton, PrimaryButton, Scaffold, Head,
    HomeModernIcon,
    RocketLaunchIcon,
    UsersIcon,
    WrenchScrewdriverIcon,
    PencilIcon,
    GlobeAltIcon,
    MicrophoneIcon,
    PlayIcon,
    PhotoIcon,
  },
  // mixins: [Mixin],
  setup(props) {

  },
  mounted() {
    // loadScript("https://d1w019qw3bn26k.cloudfront.net/assets/application-b7a4037d87fe8e15e2a75db9f136291a1fd5cea2fa810311c7c1bb44ecb6c069.js");
    // loadScript("https://www.googletagmanager.com/gtag/js?id=G-P9M5S0890F");
    // loadScript("https://unpkg.com/@alpinejs/ui@3.10.5-beta.7/dist/cdn.min.js");
    // loadScript("https://unpkg.com/@alpinejs/focus@3.10.5/dist/cdn.min.js");
    // loadScript("https://unpkg.com/@alpinejs/collapse@3.x.x/dist/cdn.min.js");
    // loadScript("https://unpkg.com/alpinejs@3.10.5/dist/cdn.min.js");
    // loadScript("https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js");

    const countupEls = document.querySelectorAll('.countup');
    countupEls.forEach(this.animateCountUp);


  },
  methods: {
    animateCountUp(el) {
      // How long you want the animation to take, in ms
      const animationDuration = 1000 + Math.random(3000);
// Calculate how long each ‘frame’ should last if we want to update the animation 60 times per second
      const frameDuration = 1000 / 60;
// Use that to calculate how many frames we need to complete the animation
      const totalFrames = Math.round(animationDuration / frameDuration);
// An ease-out function that slows the count as it progresses
      const easeOutQuad = t => t * (2 - t);


      let frame = 0;
      const countTo = parseInt(el.innerHTML, 10);
      // Start the animation running 60 times per second
      const counter = setInterval(() => {
        frame++;
        // Calculate our progress as a value between 0 and 1
        // Pass that value to our easing function to get our
        // progress on a curve
        const progress = easeOutQuad(frame / totalFrames);
        // Use the progress value to calculate the current count
        const currentCount = Math.round(countTo * progress);

        // If the current count has changed, update the element
        if (parseInt(el.innerHTML, 10) !== currentCount) {
          el.innerHTML = currentCount;
        }

        // If we’ve reached our last frame, stop the animation
        if (frame === totalFrames) {
          clearInterval(counter);
        }
      }, frameDuration);
    }
  },

}
</script>
<style>
/* ----------------------------------------------
* Generated by Animista
* w: http://animista.net, t: @cssanimista
* ---------------------------------------------- */

.slide-in-bottom {
  -webkit-animation: slide-in-bottom .5s cubic-bezier(.25, .46, .45, .94) both;
  animation: slide-in-bottom .5s cubic-bezier(.25, .46, .45, .94) both
}

.slide-in-bottom-h1 {
  -webkit-animation: slide-in-bottom .5s cubic-bezier(.25, .46, .45, .94) .5s both;
  animation: slide-in-bottom .5s cubic-bezier(.25, .46, .45, .94) .5s both
}

.slide-in-bottom-subtitle {
  -webkit-animation: slide-in-bottom .5s cubic-bezier(.25, .46, .45, .94) .75s both;
  animation: slide-in-bottom .5s cubic-bezier(.25, .46, .45, .94) .75s both
}

.fade-in {
  -webkit-animation: fade-in 1.2s cubic-bezier(.39, .575, .565, 1.000) 1s both;
  animation: fade-in 1.2s cubic-bezier(.39, .575, .565, 1.000) 1s both
}

.bounce-top-icons {
  -webkit-animation: bounce-top .9s 1s both;
  animation: bounce-top .9s 1s both
}

@-webkit-keyframes slide-in-bottom {
  0% {
    -webkit-transform: translateY(1000px);
    transform: translateY(1000px);
    opacity: 0
  }
  100% {
    -webkit-transform: translateY(0);
    transform: translateY(0);
    opacity: 1
  }
}

@keyframes slide-in-bottom {
  0% {
    -webkit-transform: translateY(1000px);
    transform: translateY(1000px);
    opacity: 0
  }
  100% {
    -webkit-transform: translateY(0);
    transform: translateY(0);
    opacity: 1
  }
}

@-webkit-keyframes bounce-top {
  0% {
    -webkit-transform: translateY(-45px);
    transform: translateY(-45px);
    -webkit-animation-timing-function: ease-in;
    animation-timing-function: ease-in;
    opacity: 1
  }
  24% {
    opacity: 1
  }
  40% {
    -webkit-transform: translateY(-24px);
    transform: translateY(-24px);
    -webkit-animation-timing-function: ease-in;
    animation-timing-function: ease-in
  }
  65% {
    -webkit-transform: translateY(-12px);
    transform: translateY(-12px);
    -webkit-animation-timing-function: ease-in;
    animation-timing-function: ease-in
  }
  82% {
    -webkit-transform: translateY(-6px);
    transform: translateY(-6px);
    -webkit-animation-timing-function: ease-in;
    animation-timing-function: ease-in
  }
  93% {
    -webkit-transform: translateY(-4px);
    transform: translateY(-4px);
    -webkit-animation-timing-function: ease-in;
    animation-timing-function: ease-in
  }
  25%, 55%, 75%, 87% {
    -webkit-transform: translateY(0);
    transform: translateY(0);
    -webkit-animation-timing-function: ease-out;
    animation-timing-function: ease-out
  }
  100% {
    -webkit-transform: translateY(0);
    transform: translateY(0);
    -webkit-animation-timing-function: ease-out;
    animation-timing-function: ease-out;
    opacity: 1
  }
}

@keyframes bounce-top {
  0% {
    -webkit-transform: translateY(-45px);
    transform: translateY(-45px);
    -webkit-animation-timing-function: ease-in;
    animation-timing-function: ease-in;
    opacity: 1
  }
  24% {
    opacity: 1
  }
  40% {
    -webkit-transform: translateY(-24px);
    transform: translateY(-24px);
    -webkit-animation-timing-function: ease-in;
    animation-timing-function: ease-in
  }
  65% {
    -webkit-transform: translateY(-12px);
    transform: translateY(-12px);
    -webkit-animation-timing-function: ease-in;
    animation-timing-function: ease-in
  }
  82% {
    -webkit-transform: translateY(-6px);
    transform: translateY(-6px);
    -webkit-animation-timing-function: ease-in;
    animation-timing-function: ease-in
  }
  93% {
    -webkit-transform: translateY(-4px);
    transform: translateY(-4px);
    -webkit-animation-timing-function: ease-in;
    animation-timing-function: ease-in
  }
  25%, 55%, 75%, 87% {
    -webkit-transform: translateY(0);
    transform: translateY(0);
    -webkit-animation-timing-function: ease-out;
    animation-timing-function: ease-out
  }
  100% {
    -webkit-transform: translateY(0);
    transform: translateY(0);
    -webkit-animation-timing-function: ease-out;
    animation-timing-function: ease-out;
    opacity: 1
  }
}

@-webkit-keyframes fade-in {
  0% {
    opacity: 0
  }
  100% {
    opacity: 1
  }
}

@keyframes fade-in {
  0% {
    opacity: 0
  }
  100% {
    opacity: 1
  }
}

</style>

