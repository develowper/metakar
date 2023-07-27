<template>
  <PanelScaffold>
    <template #header>
      <slot name="header"></slot>
    </template>

    <!--         Sidenav -->
    <template #sidenav>
      <nav id="sidenav-1"
           class="fixed start-0 top-0 z-[1035] h-screen w-60 -translate-x-full overflow-hidden bg-white shadow-[0_4px_12px_0_rgba(0,0,0,0.07),_0_2px_4px_rgba(0,0,0,0.05)] dark:bg-zinc-800 md:data-[te-sidenav-hidden='false']:translate-x-0"
           data-te-sidenav-init
           data-te-sidenav-mode-breakpoint-over="0"
           data-te-sidenav-mode-breakpoint-side="md"
           data-te-sidenav-hidden="false"
           data-te-sidenav-color="dark"
           data-te-sidenav-mode="side"
           data-te-sidenav-right="true"
           data-te-sidenav-content="#toggler"
           data-te-sidenav-scroll-container="#scrollContainer">


        <ul id="scrollContainer" class="relative m-0 list-none    text-primary-500"
            data-te-sidenav-menu-ref>
          <li class="relative">
            <Link :href="route('panel.index')"
                  class="pt-2 pb-2 flex  px-3 outline-none transition duration-300 ease-linear hover:bg-slate-200 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
                  :class="{'  text-primary-500':menuIsActive ( 'panel.index' )}"
            >
              <span class="w-full text-gray-500"> {{ __('dashboard') }}</span>
            </Link>
            <hr class="border-gray-200 dark:border-gray-700 my-2 mx-4">

            <div v-if="hasWallet()"
                 class="flex text-primary mx-2 justify-center items-center text-sm text-gray-500">
              <span class="">{{ __('wallet') + ' :' }}</span>
              <strong class="mx-2">{{ asPrice(user.wallet) }} </strong>
              <span class=""> {{ __('currency') }}</span>

              <span
                  class="mx-2   text-center  bg-success-200 text-success-700 hover:bg-success-100 cursor-pointer px-2 py-[.1rem] rounded-lg transition-all duration-300"> {{
                  __('charge')
                }}</span>
            </div>
            <hr v-if="hasWallet()" class="border-gray-200 dark:border-gray-700 my-2 mx-4">
            <div class="flex text-primary mx-2 justify-center items-center text-sm text-gray-500">
              <Tooltip class="p-2 " :content="__('help_meta')">
                <QuestionMarkCircleIcon class="text-gray-500 hover:bg-gray-50 w-4 h-4"/>
              </Tooltip>
              <span class="">{{ __('meta') + ' :' }}</span>
              <strong class="mx-2">{{ asPrice(user.meta) }} </strong>
              <span
                  class="mx-2   text-center  bg-success-200 text-success-700 hover:bg-success-100 cursor-pointer px-2 py-[.1rem] rounded-lg transition-all duration-300"> {{
                  __('charge')
                }}</span>
            </div>
            <hr class="border-primary-200 dark:border-gray-700 m-2">

          </li>
          <!-- Business links -->
          <li class="relative ">
            <a :class="{'bg-primary-50 text-primary-500':menuIsActive ( 'panel.business.*' )}"
               class="flex   cursor-pointer items-center truncate   px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-primary-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
               data-te-sidenav-link-ref>
              <HomeIcon class="w-5 h-5  "/>
              <span class="mx-2 text-sm "> {{ __('businesses') }} </span>
              <span
                  class="  right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&>svg]:text-gray-600 dark:[&>svg]:text-gray-300"
                  data-te-sidenav-rotate-icon-ref>
                                             <ChevronDownIcon class="h-5 w-5"/>
                                             </span>
            </a>
            <ul
                class="  !visible relative m-0 hidden list-none   data-[te-collapse-show]:block "
                v-bind="{ 'data-te-collapse-show':menuIsActive ( 'panel.business.*' )?true:null }"
                data-te-collapse-item
                data-te-sidenav-collapse-ref>
              <li class="relative ps-7 ">

                <Link :href="route('panel.business.index')" role="menuitem"
                      :class="subMenuIsActive( 'panel.business.index' )"
                      class="flex   border-s-2 hover:border-primary-500  items-center p-2   text-sm  transition-all duration-200   dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50">
                  <Bars2Icon class="w-5 h-5 mx-1"/>
                  {{ __('list') }}
                </Link>
                <Link :href="route('panel.business.new')" role="menuitem"
                      :class="subMenuIsActive ( 'panel.business.new' )"
                      class="flex   border-s-2 hover:border-primary-500  items-center p-2   text-sm  transition-all duration-200   dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50">
                  <PlusSmallIcon class="w-5 h-5 mx-1"/>
                  {{ __('new') }}
                </Link>
              </li>

            </ul>
          </li>

          <!-- Article links -->
          <li class="relative ">
            <a :class="{'bg-primary-50 text-primary-500':menuIsActive ( 'panel.article.*' )}"
               class="flex   cursor-pointer items-center truncate   px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-primary-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
               data-te-sidenav-link-ref>
              <NewspaperIcon class="w-5 h-5  "/>
              <span class="mx-2 text-sm "> {{ __('articles') }} </span>
              <span
                  class="  right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&>svg]:text-gray-600 dark:[&>svg]:text-gray-300"
                  data-te-sidenav-rotate-icon-ref>
                                             <ChevronDownIcon class="h-5 w-5"/>
                                             </span>
            </a>
            <ul
                v-bind="{ 'data-te-collapse-show':menuIsActive ( 'panel.article.*' )?true:null }"
                class="  !visible relative m-0 hidden list-none    data-[te-collapse-show]:block "
                data-te-collapse-item data-te-sidenav-collapse-ref>
              <li class="relative ps-7">

                <Link :href="route('panel.article.index')" role="menuitem"
                      :class="subMenuIsActive( 'panel.article.index' )"
                      class="flex   border-s-2 hover:border-primary-500  items-center p-2   text-sm  transition-all duration-200   dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50">
                  <Bars2Icon class="w-5 h-5 mx-1"/>
                  {{ __('list') }}
                </Link>
                <Link :href="route('panel.article.new')" role="menuitem"
                      :class="subMenuIsActive ( 'panel.article.new' )"
                      class="flex   border-s-2 hover:border-primary-500  items-center p-2   text-sm  transition-all duration-200   dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50">
                  <PlusSmallIcon class="w-5 h-5 mx-1"/>
                  {{ __('new') }}
                </Link>
              </li>

            </ul>
          </li>

          <!-- Site links -->
          <li class="relative  ">
            <a :class="{'bg-primary-50 text-primary-500':menuIsActive ( 'panel.site.*' )}"
               class="flex   cursor-pointer items-center truncate   px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-primary-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
               data-te-sidenav-link-ref>
              <GlobeAltIcon class="w-5 h-5  "/>
              <span class="mx-2 text-sm "> {{ __('sites') }} </span>
              <span
                  class="  right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&>svg]:text-gray-600 dark:[&>svg]:text-gray-300"
                  data-te-sidenav-rotate-icon-ref>
                                             <ChevronDownIcon class="h-5 w-5"/>
                                             </span>
            </a>
            <ul
                v-bind="{ 'data-te-collapse-show':menuIsActive ( 'panel.site.*' )?true:null }"
                class="  !visible relative m-0 hidden list-none    data-[te-collapse-show]:block "
                data-te-collapse-item data-te-sidenav-collapse-ref>
              <li class="relative ps-7">

                <Link :href="route('panel.site.index')" role="menuitem"
                      :class="subMenuIsActive( 'panel.site.index' )"
                      class="flex   border-s-2 hover:border-primary-500  items-center p-2   text-sm  transition-all duration-200   dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50">
                  <Bars2Icon class="w-5 h-5 mx-1"/>
                  {{ __('list') }}
                </Link>
                <Link :href="route('panel.site.new')" role="menuitem"
                      :class="subMenuIsActive ( 'panel.site.new' )"
                      class="flex   border-s-2 hover:border-primary-500  items-center p-2   text-sm  transition-all duration-200   dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50">
                  <PlusSmallIcon class="w-5 h-5 mx-1"/>
                  {{ __('new') }}
                </Link>
              </li>

            </ul>
          </li>

          <!-- Text links -->
          <li class="relative  ">
            <a :class="{'bg-primary-50 text-primary-500':menuIsActive ( 'panel.text.*' )}"
               class="flex   cursor-pointer items-center truncate   px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-primary-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
               data-te-sidenav-link-ref>
              <PencilSquareIcon class="w-5 h-5  "/>
              <span class="mx-2 text-sm "> {{ __('texts') }} </span>
              <span
                  class="  right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&>svg]:text-gray-600 dark:[&>svg]:text-gray-300"
                  data-te-sidenav-rotate-icon-ref>
                                             <ChevronDownIcon class="h-5 w-5"/>
                                             </span>
            </a>
            <ul
                v-bind="{ 'data-te-collapse-show':menuIsActive ( 'panel.text.*' )?true:null }"
                class="  !visible relative m-0 hidden list-none    data-[te-collapse-show]:block "
                data-te-collapse-item data-te-sidenav-collapse-ref>
              <li class="relative ps-7">

                <Link :href="route('panel.text.index')" role="menuitem"
                      :class="subMenuIsActive( 'panel.text.index' )"
                      class="flex   border-s-2 hover:border-primary-500  items-center p-2   text-sm  transition-all duration-200   dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50">
                  <Bars2Icon class="w-5 h-5 mx-1"/>
                  {{ __('list') }}
                </Link>
                <Link :href="route('panel.text.new')" role="menuitem"
                      :class="subMenuIsActive ( 'panel.text.new' )"
                      class="flex   border-s-2 hover:border-primary-500  items-center p-2   text-sm  transition-all duration-200   dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50">
                  <PlusSmallIcon class="w-5 h-5 mx-1"/>
                  {{ __('new') }}
                </Link>
              </li>

            </ul>
          </li>

          <!-- Image links -->
          <li class="relative  ">
            <a :class="{'bg-primary-50 text-primary-500':menuIsActive ( 'panel.image.*' )}"
               class="flex   cursor-pointer items-center truncate  px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-primary-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
               data-te-sidenav-link-ref>
              <PhotoIcon class="w-5 h-5  "/>
              <span class="mx-2 text-sm "> {{ __('images') }} </span>
              <span
                  class="  right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&>svg]:text-gray-600 dark:[&>svg]:text-gray-300"
                  data-te-sidenav-rotate-icon-ref>
                                             <ChevronDownIcon class="h-5 w-5"/>
                                             </span>
            </a>
            <ul
                v-bind="{ 'data-te-collapse-show':menuIsActive ( 'panel.image.*' )?true:null }"
                class="  !visible relative m-0 hidden list-none    data-[te-collapse-show]:block "
                data-te-collapse-item data-te-sidenav-collapse-ref>
              <li class="relative ps-7">

                <Link :href="route('panel.image.index')" role="menuitem"
                      :class="subMenuIsActive( 'panel.image.index' )"
                      class="flex   border-s-2 hover:border-primary-500  items-center p-2   text-sm  transition-all duration-200   dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50">
                  <Bars2Icon class="w-5 h-5 mx-1"/>
                  {{ __('list') }}
                </Link>
                <Link :href="route('panel.image.new')" role="menuitem"
                      :class="subMenuIsActive ( 'panel.image.new' )"
                      class="flex   border-s-2 hover:border-primary-500  items-center p-2   text-sm  transition-all duration-200   dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50">
                  <PlusSmallIcon class="w-5 h-5 mx-1"/>
                  {{ __('new') }}
                </Link>
              </li>

            </ul>
          </li>

          <!-- Video links -->
          <li class="relative  ">
            <a :class="{'bg-primary-50 text-primary-500':menuIsActive ( 'panel.video.*' )}"
               class="flex   cursor-pointer items-center truncate   px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-primary-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
               data-te-sidenav-link-ref>
              <FilmIcon class="w-5 h-5  "/>
              <span class="mx-2 text-sm "> {{ __('videos') }} </span>
              <span
                  class="  right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&>svg]:text-gray-600 dark:[&>svg]:text-gray-300"
                  data-te-sidenav-rotate-icon-ref>
                                             <ChevronDownIcon class="h-5 w-5"/>
                                             </span>
            </a>
            <ul
                v-bind="{ 'data-te-collapse-show':menuIsActive ( 'panel.video.*' )?true:null }"
                class="  !visible relative m-0 hidden list-none    data-[te-collapse-show]:block "
                data-te-collapse-item data-te-sidenav-collapse-ref>
              <li class="relative ps-7">

                <Link :href="route('panel.video.index')" role="menuitem"
                      :class="subMenuIsActive( 'panel.video.index' )"
                      class="flex   border-s-2 hover:border-primary-500  items-center p-2   text-sm  transition-all duration-200   dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50">
                  <Bars2Icon class="w-5 h-5 mx-1"/>
                  {{ __('list') }}
                </Link>
                <Link :href="route('panel.video.new')" role="menuitem"
                      :class="subMenuIsActive ( 'panel.video.new' )"
                      class="flex   border-s-2 hover:border-primary-500  items-center p-2   text-sm  transition-all duration-200   dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50">
                  <PlusSmallIcon class="w-5 h-5 mx-1"/>
                  {{ __('new') }}
                </Link>
              </li>

            </ul>
          </li>

          <!-- Podcast links -->
          <li class="relative  ">
            <a :class="{'bg-primary-50 text-primary-500':menuIsActive ( 'panel.podcast.*' )}"
               class="flex   cursor-pointer items-center truncate   px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-primary-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
               data-te-sidenav-link-ref>
              <MicrophoneIcon class="w-5 h-5  "/>
              <span class="mx-2 text-sm "> {{ __('podcasts') }} </span>
              <span
                  class="  right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&>svg]:text-gray-600 dark:[&>svg]:text-gray-300"
                  data-te-sidenav-rotate-icon-ref>
                                             <ChevronDownIcon class="h-5 w-5"/>
                                             </span>
            </a>
            <ul
                v-bind="{ 'data-te-collapse-show':menuIsActive ( 'panel.podcast.*' )?true:null }"
                class="  !visible relative m-0 hidden list-none    data-[te-collapse-show]:block "
                data-te-collapse-item data-te-sidenav-collapse-ref>
              <li class="relative ps-7">

                <Link :href="route('panel.podcast.index')" role="menuitem"
                      :class="subMenuIsActive( 'panel.podcast.index' )"
                      class="flex   border-s-2 hover:border-primary-500  items-center p-2   text-sm  transition-all duration-200   dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50">
                  <Bars2Icon class="w-5 h-5 mx-1"/>
                  {{ __('list') }}
                </Link>
                <Link :href="route('panel.podcast.new')" role="menuitem"
                      :class="subMenuIsActive ( 'panel.podcast.new' )"
                      class="flex   border-s-2 hover:border-primary-500  items-center p-2   text-sm  transition-all duration-200   dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50">
                  <PlusSmallIcon class="w-5 h-5 mx-1"/>
                  {{ __('new') }}
                </Link>
              </li>

            </ul>
          </li>

          <!-- Auction links -->
          <li class="relative  ">
            <a :class="{'bg-primary-50 text-primary-500':menuIsActive ( 'panel.auction.*' )}"
               class="flex   cursor-pointer items-center truncate  px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-primary-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
               data-te-sidenav-link-ref>
              <MegaphoneIcon class="w-5 h-5  "/>
              <span class="mx-2 text-sm "> {{ __('auctions') }} </span>
              <span
                  class="  right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&>svg]:text-gray-600 dark:[&>svg]:text-gray-300"
                  data-te-sidenav-rotate-icon-ref>
                                             <ChevronDownIcon class="h-5 w-5"/>
                                             </span>
            </a>
            <ul
                v-bind="{ 'data-te-collapse-show':menuIsActive ( 'panel.auction.*' )?true:null }"
                class="  !visible relative m-0 hidden list-none    data-[te-collapse-show]:block "
                data-te-collapse-item data-te-sidenav-collapse-ref>
              <li class="relative ps-7">

                <Link :href="route('panel.auction.index')" role="menuitem"
                      :class="subMenuIsActive( 'panel.auction.index' )"
                      class="flex   border-s-2 hover:border-primary-500  items-center p-2   text-sm  transition-all duration-200   dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50">
                  <Bars2Icon class="w-5 h-5 mx-1"/>
                  {{ __('list') }}
                </Link>
                <Link :href="route('panel.auction.new')" role="menuitem"
                      :class="subMenuIsActive ( 'panel.auction.new' )"
                      class="flex   border-s-2 hover:border-primary-500  items-center p-2   text-sm  transition-all duration-200   dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50">
                  <PlusSmallIcon class="w-5 h-5 mx-1"/>
                  {{ __('new') }}
                </Link>
              </li>

            </ul>
          </li>

          <!-- Support links -->
          <li class="relative  ">
            <a :class="{'bg-primary-50 text-primary-500':menuIsActive ( 'panel.ticket.*' )}"
               class="flex   cursor-pointer items-center truncate   px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-primary-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
               data-te-sidenav-link-ref>
              <LightBulbIcon class="w-5 h-5  "/>
              <span class="mx-2 text-sm "> {{ __('support') }} </span>
              <span
                  class="  right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&>svg]:text-gray-600 dark:[&>svg]:text-gray-300"
                  data-te-sidenav-rotate-icon-ref>
                                             <ChevronDownIcon class="h-5 w-5"/>
                                             </span>
            </a>
            <ul
                v-bind="{ 'data-te-collapse-show':menuIsActive ( 'panel.ticket.*' )?true:null }"
                class="  !visible relative m-0 hidden list-none    data-[te-collapse-show]:block "
                data-te-collapse-item data-te-sidenav-collapse-ref>
              <li class="relative ps-7">

                <Link :href="route('panel.ticket.index')" role="menuitem"
                      :class="subMenuIsActive( 'panel.ticket.index' )"
                      class="flex   border-s-2 hover:border-primary-500  items-center p-2   text-sm  transition-all duration-200   dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50">
                  <Bars2Icon class="w-5 h-5 mx-1"/>
                  {{ __('tickets') }}
                </Link>
                <Link :href="route('panel.ticket.new')" role="menuitem"
                      :class="subMenuIsActive ( 'panel.ticket.new' )"
                      class="flex   border-s-2 hover:border-primary-500  items-center p-2   text-sm  transition-all duration-200   dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50">
                  <PlusSmallIcon class="w-5 h-5 mx-1"/>
                  {{ __('new_ticket') }}
                </Link>
              </li>

            </ul>
          </li>

          <!-- Financial links -->
          <li class="relative  ">
            <a :class="{'bg-primary-50 text-primary-500':menuIsActive ( 'panel.financial.*' )}"
               class="flex   cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-primary-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
               data-te-sidenav-link-ref>
              <CurrencyDollarIcon class="w-5 h-5  "/>
              <span class="mx-2 text-sm "> {{ __('financial') }} </span>
              <span
                  class="  right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&>svg]:text-gray-600 dark:[&>svg]:text-gray-300"
                  data-te-sidenav-rotate-icon-ref>
                                             <ChevronDownIcon class="h-5 w-5"/>
                                             </span>
            </a>
            <ul
                v-bind="{ 'data-te-collapse-show':menuIsActive ( 'panel.financial.*' )?true:null }"
                class="  !visible relative m-0 hidden list-none    data-[te-collapse-show]:block "
                data-te-collapse-item data-te-sidenav-collapse-ref>
              <li class="relative ps-7">

                <Link :href="route('panel.financial.transaction.index')" role="menuitem"
                      :class="subMenuIsActive( 'panel.financial.transaction.index' )"
                      class="flex   border-s-2 hover:border-primary-500  items-center p-2   text-sm  transition-all duration-200   dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50">
                  <Bars2Icon class="w-5 h-5 mx-1"/>
                  {{ __('transactions') }}
                </Link>

              </li>

            </ul>
          </li>

          <li>
            <div class="py-4">

            </div>
          </li>
        </ul>
      </nav>
    </template>

    <template #content>
      <slot name="content"></slot>
    </template>
  </PanelScaffold>
</template>

<script>
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
  ArrowRightOnRectangleIcon,
} from "@heroicons/vue/24/outline";
import {
  QuestionMarkCircleIcon
} from "@heroicons/vue/24/solid";
import Image from '@/Components/Image.vue';
import Toast from '@/Components/Toast.vue';
import Tooltip from '@/Components/Tooltip.vue';
import {useRemember} from '@inertiajs/vue3';
import {initTE, Dropdown, Sidenav} from "tw-elements";
import PanelScaffold from "@/Layouts/PanelScaffold.vue";
import {provide, ref} from 'vue';


export default {
  setup() {

    // const weatherData = ref('hi');
    // provide('showToast', weatherData);


  },

  data() {
    return {
      open: false,

      isMobileMainMenuOpen: false,
      isMobileSubMenuOpen: false,
      isOn: false,
      activeTabe: false,
      isNotificationsPanelOpen: false,
      isOpen: {'business': false, 'article': false,},
      user: this.$page.props.auth.user,

    }
  },
  props: [],
  created() {
  },
  mounted() {

    // this.$nextTick(function () {
    //     console.log(this.$parent.toast);
    // });
    // console.log(this.$emit('showToast'))
    // this.$refs.toast.success('hi');
    // loadScript("https://cdn.jsdelivr.net/gh/alpine-collective/alpine-magic-helpers@0.5.x/dist/component.min.js")
    // loadScript("https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js")
  },
  watch: {
    // isOpen: {
    //     handler(val) {
    //         localStorage.setItem("menuStatus", JSON.stringify(val));
    //     },
    //     deep: true,
    // }
  },
  components: {
    PanelScaffold,
    Toast,
    Head,
    Link,
    HomeIcon,
    ChevronDownIcon,
    Bars3Icon,
    Image,
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
    ArrowRightOnRectangleIcon,
    Tooltip,
    QuestionMarkCircleIcon,
  },
  methods: {
    delay(time) {
      return new Promise(resolve => setTimeout(resolve, time));
    },

    menuIsActive(link) {
      return this.route().current(`${link}`);
    },
    subMenuIsActive(link) {
      return this.route().current(`${link}`) ? "text-primary-700 border-s border-primary-500  " : "text-gray-500   ";
    },

  },
}
</script>
