<template>
    <main :dir="dir()" class="min-h-screen panel   " :class="{'dark':isDark}">
        <Head>
            <slot name="header"/>
        </head>
        <div class="  flex h-screen antialiased text-gray-900 bg-gray-100 dark:bg-dark dark:text-light">
            <!-- Loading screen -->
            <div v-if="loading"
                 class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-primary-darker hidden">
                Loading.....
            </div>


            <!-- Sidebar -->
            <aside

                class="  overflow-x-hidden  ">

                <!-- Sidenav -->
                <nav id="sidenav-1"
                     class="fixed start-0 top-0 z-[1035] h-screen w-60 -translate-x-full overflow-hidden bg-white shadow-[0_4px_12px_0_rgba(0,0,0,0.07),_0_2px_4px_rgba(0,0,0,0.05)] dark:bg-zinc-800 md:data-[te-sidenav-hidden='false']:translate-x-0"
                     data-te-sidenav-init
                     data-te-sidenav-mode-breakpoint-over="0"
                     data-te-sidenav-mode-breakpoint-side="md"
                     data-te-sidenav-hidden="false"
                     data-te-sidenav-color="dark"
                     data-te-sidenav-right="true"
                     data-te-sidenav-content="#content"
                     data-te-sidenav-scroll-container="#scrollContainer">


                    <ul id="scrollContainer" class="relative m-0 list-none    text-primary-500"
                        data-te-sidenav-menu-ref>
                        <li class="relative">
                            <Link :href="route('panel.index')"
                                  class="py-6 flex    text-center outline-none transition duration-300 ease-linear hover:bg-slate-200 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
                                  :class="{'bg-primary-100 text-primary-500':menuIsActive ( 'panel.index' )}"
                            >
                                <span class="w-full"> {{ __('dashboard') }}</span>
                            </Link>
                        </li>
                        <!-- Business links -->
                        <li class="relative ">
                            <a :class="{'bg-primary-50 text-primary-500':menuIsActive ( 'panel.business.*' )}"
                               class="flex   cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-primary-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
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
                               class="flex   cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-primary-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
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
                               class="flex   cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-primary-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
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
                               class="flex   cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-primary-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
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
                               class="flex   cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-primary-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
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
                               class="flex   cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-primary-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
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
                               class="flex   cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-primary-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
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
                               class="flex   cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-primary-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
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
                               class="flex   cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-primary-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
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
                <span class="[&amp;>svg]:w-7 text-primary-500">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-7 w-7">
                    <path fill-rule="evenodd"
                          d="M3 6.75A.75.75 0 013.75 6h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 6.75zM3 12a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 12zm0 5.25a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75z"
                          clip-rule="evenodd"></path>
                  </svg>
                </span>
                        </button>

                        <!-- Brand -->
                        <Link :href="route('/')"
                              class="inline-block text-2xl font-bold tracking-wider   text-primary-500 dark:text-light">
                            {{ __('app_name') }}
                        </Link>


                        <!-- Left Right buttons -->
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
                                        src="https://images.unsplash.com/photo-1523779917675-b6ed3a42a561?ixid=MnwxMjA3fDB8MHxzZWFyY2h8N3x8d29tYW4lMjBibHVlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=face&w=500&q=200"
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
                    <slot name="content"/>
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
import Image from '../Components/Image.vue';
import {useRemember} from '@inertiajs/vue3';
import {router} from '@inertiajs/vue3';
import {initTE, Dropdown, Sidenav} from "tw-elements";

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
        if (!window.Dropdown) {
            window.Dropdown = Dropdown;
            initTE({Dropdown});
        }
        initTE({Sidenav});
        const sidenav = document.getElementById("sidenav-1");
        const sidenavInstance = Sidenav.getInstance(sidenav);

        let innerWidth = null;

        const setMode = (e) => {
            // Check necessary for Android devices
            if (window.innerWidth === innerWidth) {
                return;
            }

            innerWidth = window.innerWidth;

            if (window.innerWidth < sidenavInstance.getBreakpoint("md")) {
                sidenavInstance.changeMode("over");
                sidenavInstance.hide();
            } else {
                sidenavInstance.changeMode("side");
                sidenavInstance.show();
            }
        };

        if (window.innerWidth < sidenavInstance.getBreakpoint("md")) {
            setMode();
        }

        window.addEventListener("resize", setMode);


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
        ArrowRightOnRectangleIcon
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
