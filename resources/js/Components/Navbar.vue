<template>
  <nav class="fixed w-full z-30 top-0">
    <div class="max-w-7xl  mx-auto   px-2 lg:px-4">
      <div class="flex justify-between">
        <div class="flex space-x-4">
          <!-- Website Logo -->
          <div>
            <Link :href="route('/')" class="flex items-center py-4 px-2">
              <ApplicationLogo class="w-9 h-9 fill-current text-primary-600"/>
              <span class="font-semibold text-white nav-item text-lg"
              >{{ __('app_name') }}</span>

            </Link>
          </div>

        </div>
        <!-- Primary Navbar items -->
        <div
            class="hidden md:flex items-center grow  justify-around  text-xs  transition-all duration-500">
          <div class="flex items-center">
            <Link :href="route('/')" class="px-4 nav-item" :class="navClasses('/')">
              {{ __('home') }}
            </Link>
            <Link :href="route('business.index')" class="nav-item" :class="navClasses('business')">
              {{ __('businesses') }}
            </Link>
            <Link :href="route('article.index')" class="nav-item" :class="navClasses('article')">
              {{ __('articles') }}
            </Link>
            <Link :href="route('video.index')" class="nav-item" :class="navClasses('video')">
              {{ __('videos') }}
            </Link>

            <Link :href="route('podcast.index')" class="nav-item" :class="navClasses('podcast')">
              {{ __('podcasts') }}
            </Link>
            <Link :href="route('banner.index')" class="nav-item" :class="navClasses('banner')">
              {{ __('banners') }}
            </Link>
            <Link :href="route('site.index')" class="nav-item" :class="navClasses('site')">
              {{ __('increase_view') }}
            </Link>
            <Link :href="route('page.make_money')" class="nav-item" :class="navClasses('make_money')">
              {{ __('make_money') }}
            </Link>
            <!--                        <Link :href="route('exchange.index')" class="nav-item" :class="navClasses('exchange')">-->
            <!--                            {{ __('exchange') }}-->
            <!--                        </Link>-->
          </div>
          <div class="flex items-center">
            <Link :href="route('page.prices')" class="nav-item" :class="navClasses('prices')">
              {{ __('prices') }}
            </Link>
            <Link :href="route('page.help')" class="nav-item" :class="navClasses('help')">
              {{ __('help') }}
            </Link>
            <Link :href="route('page.contact_us')" class="nav-item" :class="navClasses('contact_us')">
              {{ __('contact_us') }}
            </Link>

          </div>

        </div>
        <!-- Secondary Navbar items -->
        <div class="   flex items-center space-x-3   ">
          <UserButton/>
          <LanguageButton/>
        </div>
        <!-- Mobile menu button -->
        <div class="md:hidden flex items-center nav-item ">
          <button class="h-9 w-9   border-2 rounded  mobile-menu-button ">
            <Bars3Icon class=" " className="  "/>
          </button>
        </div>
      </div>
    </div>
    <!-- mobile menu -->
    <div class="hidden mobile-menu">
      <ul class="">
        <li class="active"><a href="index.html"
                              class="block text-sm px-2 py-4 text-white bg-green-500 font-semibold">Home</a>
        </li>
        <li><a href="#services"
               class="block text-sm px-2 py-4 hover:text-white hover:bg-green-500 transition duration-300">Services</a>
        </li>

      </ul>
    </div>
    <!--        <hr class="border-b border-gray-100 opacity-25 my-0 py-0"/>-->
  </nav>

</template>
<script>

import LanguageButton from "@/Components/LanguageButton.vue";
import UserButton from "@/Components/UserButton.vue";
import {Head, Link} from '@inertiajs/vue3';
import {Bars3Icon, UserIcon} from "@heroicons/vue/24/outline";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

export default {
  components: {
    ApplicationLogo,
    LanguageButton, UserButton, Bars3Icon, UserIcon, Link, Head
  },
  props: ['theme'],
  data() {
    return {}
  }, mounted() {
    const btn = document.querySelector("button.mobile-menu-button");
    const menu = document.querySelector(".mobile-menu");

    // Add Event Listeners
    btn.addEventListener("click", () => {
      menu.classList.toggle("hidden");

    });

    this.setScrollListener();
  },
  methods: {
    navClasses(item) {
      let base = "py-4 px-1 lg:px-2  text-white font-semibold  transition  duration-300 hover:border-primary-500 hover:text-primary-900 hover:border-b-4 transition  duration-300 ";
      if (item && (this.route().current(`${item}.*`) || this.route().current(`${item}`)))
        base += "border-b-4 border-primary-500";
      return base;
    },
    setScrollListener() {
      var scrollpos = window.scrollY;
      var nav = document.getElementsByTagName("nav")[0];
      var links = document.querySelectorAll(".nav-item");
      if (this.theme == 'light') {
        nav.classList.remove("bg-transparent");
        nav.classList.add("bg-white");
        nav.classList.remove("text-white");
        nav.classList.add("text-primary-500");
        nav.classList.add("shadow-lg");

        for (let el of links) {
          el.classList.remove("text-white");
          el.classList.add("text-primary-500");
        }
        return;
      } else {
        nav.classList.add("bg-transparent");
        nav.classList.remove("bg-white");
        nav.classList.add("text-white");
        nav.classList.remove("text-primary-500");
        nav.classList.remove("shadow-lg");

        for (let el of links) {
          el.classList.add("text-white");
          el.classList.remove("text-primary-500");
        }


      }

      document.addEventListener("scroll", function () {
        /*Apply classes for slide in bar*/
        scrollpos = window.scrollY;
        for (let el of links) {
          el.classList.remove("text-primary-500");
          el.classList.add("text-white");
        }
        if (scrollpos > 10) {
          nav.classList.remove("bg-transparent");
          nav.classList.add("bg-white");
          nav.classList.remove("text-white");
          nav.classList.add("text-primary-500");
          nav.classList.add("shadow-lg");

          for (let el of links) {
            el.classList.remove("text-white");
            el.classList.add("text-primary-500");
          }
        } else {
          nav.classList.add("bg-transparent");
          nav.classList.remove("bg-white");
          nav.classList.add("text-white");
          nav.classList.remove("text-primary-500");
          nav.classList.remove("shadow-lg");

          for (let el of links) {
            el.classList.add("text-white");
            el.classList.remove("text-primary-500");
          }


        }
      });

    }
  }
}
</script>

<style lang="scss">
.nav-item {
  //color: white;
}
</style>
