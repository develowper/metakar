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

                class="  flex-shrink-0 shadow-lg hidden w-64 bg-white
                dark:border-primary      md:block">

                <!-- Sidebar links -->
                <nav v-if="false" :dir="dir()=='rtl'?'ltr':'rtl'" aria-label="Main"
                     class="flex-1 px-2 py-4 space-y-2   ">
                    <div :dir="dir()">
                        <!-- sidebar top gap -->
                        <div class="py-4">

                        </div>


                    </div>
                </nav>


                <!-- Sidenav -->
                <nav
                    id="sidenav-2"
                    class="fixed start-0 top-0 z-[1035] h-screen w-60 -translate-x-full overflow-hidden bg-white  data-[te-sidenav-hidden='false']:translate-x-0 dark:bg-zinc-800"
                    data-te-sidenav-init
                    data-te-sidenav-hidden="false"
                    data-te-sidenav-mode="side"
                    data-te-sidenav-right="true"
                    data-te-sidenav-content="#content">
                    <ul class="relative m-0 list-none px-[0.2rem]" data-te-sidenav-menu-ref>
                        <li class="relative">
                            <div class="py-4">

                            </div>
                        </li>
                        <!-- Business links -->
                        <li class="relative ">
                            <a :class="{'bg-primary-50 text-primary-500':menuIsActive ( 'panel.business.*' )}"
                               class="flex   cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
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
                        <li class="relative text-primary-500">
                            <a :class="{'bg-primary-50 text-primary-500':menuIsActive ( 'panel.article.*' )}"
                               class="flex   cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
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
                        <li class="relative text-primary-500">
                            <a :class="{'bg-primary-50 text-primary-500':menuIsActive ( 'panel.site.*' )}"
                               class="flex   cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
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
                        <li class="relative text-primary-500">
                            <a :class="{'bg-primary-50 text-primary-500':menuIsActive ( 'panel.text.*' )}"
                               class="flex   cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
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
                        <li class="relative text-primary-500">
                            <a :class="{'bg-primary-50 text-primary-500':menuIsActive ( 'panel.image.*' )}"
                               class="flex   cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
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
                        <li class="relative text-primary-500">
                            <a :class="{'bg-primary-50 text-primary-500':menuIsActive ( 'panel.video.*' )}"
                               class="flex   cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
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
                        <li class="relative text-primary-500">
                            <a :class="{'bg-primary-50 text-primary-500':menuIsActive ( 'panel.podcast.*' )}"
                               class="flex   cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
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
                        <li class="relative text-primary-500">
                            <a :class="{'bg-primary-50 text-primary-500':menuIsActive ( 'panel.auction.*' )}"
                               class="flex   cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
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
                        <li class="relative text-primary-500">
                            <a :class="{'bg-primary-50 text-primary-500':menuIsActive ( 'panel.ticket.*' )}"
                               class="flex   cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
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
                        <li class="relative text-primary-500">
                            <a :class="{'bg-primary-50 text-primary-500':menuIsActive ( 'panel.financial.*' )}"
                               class="flex   cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
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
            <div class="flex-1 h-full overflow-x-hidden overflow-y-auto">
                <!-- Navbar -->
                <header class="relative bg-white dark:bg-darker">
                    <div class="flex items-center justify-between p-2 border-b dark:border-primary-darker">
                        <!-- Mobile menu button -->
                        <button @click="isMobileMainMenuOpen = !isMobileMainMenuOpen"
                                class="p-1 transition-colors duration-200 rounded-md text-primary-lighter bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark md:hidden focus:outline-none focus:ring">
                            <span class="sr-only">Open main manu</span>
                            <span aria-hidden="true">
                  <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                       stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"></path>
                  </svg>
                </span>
                        </button>

                        <!-- Brand -->
                        <Link :href="route('/')"
                              class="inline-block text-2xl font-bold tracking-wider   text-primary-500 dark:text-light">
                            {{ __('app_name') }}
                        </Link>


                        <!-- Desktop Right buttons -->
                        <nav aria-label="Secondary" class="p-1  space-x-2  flex  items-center">
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
                            <button @click="openNotificationsPanel"
                                    class=" relative p-1  mx-2 transition-colors duration-200 rounded-full text-primary-500 bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark focus:outline-none focus:bg-primary-100 dark:focus:bg-primary-dark focus:ring-primary-darker">
                                <span class="sr-only">Open Notification panel</span>
                                <span v-if="$page.props.auth.user.notifications>0"
                                      class="bg-red-500 rounded-full p-[.3rem] absolute top-0 start-0 animate-pulse"> </span>
                                <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                            </button>


                            <!-- Settings button -->
                            <button @click="openSettingsPanel"
                                    class="p-1   transition-colors duration-200 rounded-full text-primary-500 bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark focus:outline-none focus:bg-primary-100 dark:focus:bg-primary-dark focus:ring-primary-darker">
                                <span class="sr-only">Open settings panel</span>
                                <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </button>

                            <!-- User avatar button -->
                            <div class="relative flex  ">
                                <button @click="openSettingsPanel"
                                        class="  transition-colors duration-200 rounded-full text-primary-500 bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark focus:outline-none focus:bg-primary-100 dark:focus:bg-primary-dark focus:ring-primary-darker">

                                    <span class="sr-only">User menu</span>
                                    <Image
                                        classes="    object-cover   rounded-full w-8 h-8  "
                                        src="https://images.unsplash.com/photo-1523779917675-b6ed3a42a561?ixid=MnwxMjA3fDB8MHxzZWFyY2h8N3x8d29tYW4lMjBibHVlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=face&w=500&q=200"
                                        alt="jane avatar"
                                        type="user"/>
                                </button>

                                <!-- User dropdown menu -->
                                <div ref="userMenu"
                                     class="absolute right-0 w-48 py-1 bg-white rounded-md shadow-lg top-12 ring-1 ring-black ring-opacity-5 dark:bg-dark focus:outline-none"
                                     tabindex="-1" role="menu" aria-orientation="vertical" aria-label="User menu"
                                     style="display: none;">
                                    <a href="#" role="menuitem"
                                       class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary">
                                        Your Profile
                                    </a>
                                    <a href="#" role="menuitem"
                                       class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary">
                                        Settings
                                    </a>
                                    <a href="#" role="menuitem"
                                       class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary">
                                        Logout
                                    </a>
                                </div>
                            </div>
                        </nav>

                    </div>
                    <!-- Mobile main manu -->
                    <div class="border-b md:hidden dark:border-primary-darker" v-show="isMobileMainMenuOpen"
                         @click="isMobileMainMenuOpen = false" style="display: none;">
                        <nav aria-label="Main" class="px-2 py-4 space-y-2">

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
} from "@heroicons/vue/24/outline";
import Image from '@/Components/Image.vue';
import {useRemember} from '@inertiajs/vue3';
import {router} from '@inertiajs/vue3';
import {Sidenav, initTE, Carousel, Datepicker, Select, Timepicker} from "tw-elements";

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
            isOpen: {'business': false, 'article': false,}
        }
    },
    props: [],
    created() {
    },
    mounted() {
        this.initSideNav();

        // let data = localStorage.getItem("menuStatus",);
        // if (data)
        //     try {
        //         this.isOpen = JSON.parse(data);
        //     } catch (error) {
        //         localStorage.removeItem("menuStatus",);
        //     }


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
    },
    methods: {
        delay(time) {
            return new Promise(resolve => setTimeout(resolve, time));
        },
        toggleMenu(el) {

            el.firstChild.lastChild.style.cssText = "-webkit-transition: all 0.3s ease-in-out;"
            el.firstChild.lastChild.classList.toggle('rotate-180');

            // el.lastChild.classList.toggle('opacity-0');

            el.lastChild.classList.toggle('hidden');

            // el.lastChild.style.display = el.lastChild.style.display == 'none' ? 'block' : 'none';


        },
        menuIsActive(link) {
            return this.route().current(`${link}`);
        },
        subMenuIsActive(link) {
            return this.route().current(`${link}`) ? "text-primary-700 border-s border-primary-500  " : "text-gray-500   ";
        },
        initSideNav() {
            initTE({Sidenav, Carousel, Datepicker, Select, Timepicker});

        }
    },
}
</script>
