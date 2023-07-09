import { Head, Link } from "@inertiajs/vue3";
import "vue-plugin-load-script";
import { HomeIcon, ChevronDownIcon, Bars3Icon, PlusSmallIcon, Bars2Icon, NewspaperIcon, WindowIcon, GlobeAltIcon, PencilSquareIcon, PhotoIcon, FilmIcon, MicrophoneIcon, MegaphoneIcon, LightBulbIcon, CurrencyDollarIcon } from "@heroicons/vue/24/outline";
import { I as Image } from "./Image-0110566e.mjs";
import { initTE, Sidenav, Carousel, Datepicker, Select, Timepicker } from "tw-elements";
import { resolveComponent, mergeProps, withCtx, renderSlot, createVNode, createTextVNode, toDisplayString, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrRenderComponent, ssrRenderSlot, ssrRenderClass, ssrInterpolate, ssrRenderStyle } from "vue/server-renderer";
import { _ as _export_sfc } from "./_plugin-vue_export-helper-cc2b3d55.mjs";
const _sfc_main = {
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
      isOpen: { "business": false, "article": false }
    };
  },
  props: [],
  created() {
  },
  mounted() {
    this.initSideNav();
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
    CurrencyDollarIcon
  },
  methods: {
    delay(time) {
      return new Promise((resolve) => setTimeout(resolve, time));
    },
    toggleMenu(el) {
      el.firstChild.lastChild.style.cssText = "-webkit-transition: all 0.3s ease-in-out;";
      el.firstChild.lastChild.classList.toggle("rotate-180");
      el.lastChild.classList.toggle("hidden");
    },
    menuIsActive(link) {
      return this.route().current(`${link}`);
    },
    subMenuIsActive(link) {
      return this.route().current(`${link}`) ? "text-primary-700 border-s border-primary-500  " : "text-gray-500   ";
    },
    initSideNav() {
      initTE({ Sidenav, Carousel, Datepicker, Select, Timepicker });
    }
  }
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_Head = resolveComponent("Head");
  const _component_HomeIcon = resolveComponent("HomeIcon");
  const _component_ChevronDownIcon = resolveComponent("ChevronDownIcon");
  const _component_Link = resolveComponent("Link");
  const _component_Bars2Icon = resolveComponent("Bars2Icon");
  const _component_PlusSmallIcon = resolveComponent("PlusSmallIcon");
  const _component_NewspaperIcon = resolveComponent("NewspaperIcon");
  const _component_GlobeAltIcon = resolveComponent("GlobeAltIcon");
  const _component_PencilSquareIcon = resolveComponent("PencilSquareIcon");
  const _component_PhotoIcon = resolveComponent("PhotoIcon");
  const _component_FilmIcon = resolveComponent("FilmIcon");
  const _component_MicrophoneIcon = resolveComponent("MicrophoneIcon");
  const _component_MegaphoneIcon = resolveComponent("MegaphoneIcon");
  const _component_LightBulbIcon = resolveComponent("LightBulbIcon");
  const _component_CurrencyDollarIcon = resolveComponent("CurrencyDollarIcon");
  const _component_Image = resolveComponent("Image");
  _push(`<main${ssrRenderAttrs(mergeProps({
    dir: _ctx.dir(),
    class: ["min-h-screen panel", { "dark": $data.isDark }]
  }, _attrs))}>`);
  _push(ssrRenderComponent(_component_Head, null, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        ssrRenderSlot(_ctx.$slots, "header", {}, null, _push2, _parent2, _scopeId);
      } else {
        return [
          renderSlot(_ctx.$slots, "header")
        ];
      }
    }),
    _: 3
  }, _parent));
  _push(`<div class="flex h-screen antialiased text-gray-900 bg-gray-100 dark:bg-dark dark:text-light">`);
  if ($data.loading) {
    _push(`<div class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-primary-darker hidden"> Loading..... </div>`);
  } else {
    _push(`<!---->`);
  }
  _push(`<aside class="flex-shrink-0 shadow-lg hidden w-64 bg-white dark:border-primary md:block">`);
  {
    _push(`<!---->`);
  }
  _push(`<nav id="sidenav-2" class="fixed start-0 top-0 z-[1035] h-screen w-60 -translate-x-full overflow-hidden bg-white data-[te-sidenav-hidden=&#39;false&#39;]:translate-x-0 dark:bg-zinc-800" data-te-sidenav-init data-te-sidenav-hidden="false" data-te-sidenav-mode="side" data-te-sidenav-right="true" data-te-sidenav-content="#content"><ul class="relative m-0 list-none px-[0.2rem]" data-te-sidenav-menu-ref><li class="relative"><div class="py-4"></div></li><li class="relative"><a class="${ssrRenderClass([{ "bg-primary-50 text-primary-500": $options.menuIsActive("panel.business.*") }, "flex cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"])}" data-te-sidenav-link-ref>`);
  _push(ssrRenderComponent(_component_HomeIcon, { class: "w-5 h-5" }, null, _parent));
  _push(`<span class="mx-2 text-sm">${ssrInterpolate(_ctx.__("businesses"))}</span><span class="right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&amp;&gt;svg]:text-gray-600 dark:[&amp;&gt;svg]:text-gray-300" data-te-sidenav-rotate-icon-ref>`);
  _push(ssrRenderComponent(_component_ChevronDownIcon, { class: "h-5 w-5" }, null, _parent));
  _push(`</span></a><ul${ssrRenderAttrs(mergeProps({ class: "!visible relative m-0 hidden list-none data-[te-collapse-show]:block" }, { "data-te-collapse-show": $options.menuIsActive("panel.business.*") ? true : null }, {
    "data-te-collapse-item": "",
    "data-te-sidenav-collapse-ref": ""
  }))}><li class="relative ps-7">`);
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("panel.business.index"),
    role: "menuitem",
    class: [$options.subMenuIsActive("panel.business.index"), "flex border-s-2 hover:border-primary-500 items-center p-2 text-sm transition-all duration-200 dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50"]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(ssrRenderComponent(_component_Bars2Icon, { class: "w-5 h-5 mx-1" }, null, _parent2, _scopeId));
        _push2(` ${ssrInterpolate(_ctx.__("list"))}`);
      } else {
        return [
          createVNode(_component_Bars2Icon, { class: "w-5 h-5 mx-1" }),
          createTextVNode(" " + toDisplayString(_ctx.__("list")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("panel.business.new"),
    role: "menuitem",
    class: [$options.subMenuIsActive("panel.business.new"), "flex border-s-2 hover:border-primary-500 items-center p-2 text-sm transition-all duration-200 dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50"]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(ssrRenderComponent(_component_PlusSmallIcon, { class: "w-5 h-5 mx-1" }, null, _parent2, _scopeId));
        _push2(` ${ssrInterpolate(_ctx.__("new"))}`);
      } else {
        return [
          createVNode(_component_PlusSmallIcon, { class: "w-5 h-5 mx-1" }),
          createTextVNode(" " + toDisplayString(_ctx.__("new")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`</li></ul></li><li class="relative text-primary-500"><a class="${ssrRenderClass([{ "bg-primary-50 text-primary-500": $options.menuIsActive("panel.article.*") }, "flex cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"])}" data-te-sidenav-link-ref>`);
  _push(ssrRenderComponent(_component_NewspaperIcon, { class: "w-5 h-5" }, null, _parent));
  _push(`<span class="mx-2 text-sm">${ssrInterpolate(_ctx.__("articles"))}</span><span class="right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&amp;&gt;svg]:text-gray-600 dark:[&amp;&gt;svg]:text-gray-300" data-te-sidenav-rotate-icon-ref>`);
  _push(ssrRenderComponent(_component_ChevronDownIcon, { class: "h-5 w-5" }, null, _parent));
  _push(`</span></a><ul${ssrRenderAttrs(mergeProps({ "data-te-collapse-show": $options.menuIsActive("panel.article.*") ? true : null }, {
    class: "!visible relative m-0 hidden list-none data-[te-collapse-show]:block",
    "data-te-collapse-item": "",
    "data-te-sidenav-collapse-ref": ""
  }))}><li class="relative ps-7">`);
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("panel.article.index"),
    role: "menuitem",
    class: [$options.subMenuIsActive("panel.article.index"), "flex border-s-2 hover:border-primary-500 items-center p-2 text-sm transition-all duration-200 dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50"]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(ssrRenderComponent(_component_Bars2Icon, { class: "w-5 h-5 mx-1" }, null, _parent2, _scopeId));
        _push2(` ${ssrInterpolate(_ctx.__("list"))}`);
      } else {
        return [
          createVNode(_component_Bars2Icon, { class: "w-5 h-5 mx-1" }),
          createTextVNode(" " + toDisplayString(_ctx.__("list")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("panel.article.new"),
    role: "menuitem",
    class: [$options.subMenuIsActive("panel.article.new"), "flex border-s-2 hover:border-primary-500 items-center p-2 text-sm transition-all duration-200 dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50"]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(ssrRenderComponent(_component_PlusSmallIcon, { class: "w-5 h-5 mx-1" }, null, _parent2, _scopeId));
        _push2(` ${ssrInterpolate(_ctx.__("new"))}`);
      } else {
        return [
          createVNode(_component_PlusSmallIcon, { class: "w-5 h-5 mx-1" }),
          createTextVNode(" " + toDisplayString(_ctx.__("new")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`</li></ul></li><li class="relative text-primary-500"><a class="${ssrRenderClass([{ "bg-primary-50 text-primary-500": $options.menuIsActive("panel.site.*") }, "flex cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"])}" data-te-sidenav-link-ref>`);
  _push(ssrRenderComponent(_component_GlobeAltIcon, { class: "w-5 h-5" }, null, _parent));
  _push(`<span class="mx-2 text-sm">${ssrInterpolate(_ctx.__("sites"))}</span><span class="right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&amp;&gt;svg]:text-gray-600 dark:[&amp;&gt;svg]:text-gray-300" data-te-sidenav-rotate-icon-ref>`);
  _push(ssrRenderComponent(_component_ChevronDownIcon, { class: "h-5 w-5" }, null, _parent));
  _push(`</span></a><ul${ssrRenderAttrs(mergeProps({ "data-te-collapse-show": $options.menuIsActive("panel.site.*") ? true : null }, {
    class: "!visible relative m-0 hidden list-none data-[te-collapse-show]:block",
    "data-te-collapse-item": "",
    "data-te-sidenav-collapse-ref": ""
  }))}><li class="relative ps-7">`);
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("panel.site.index"),
    role: "menuitem",
    class: [$options.subMenuIsActive("panel.site.index"), "flex border-s-2 hover:border-primary-500 items-center p-2 text-sm transition-all duration-200 dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50"]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(ssrRenderComponent(_component_Bars2Icon, { class: "w-5 h-5 mx-1" }, null, _parent2, _scopeId));
        _push2(` ${ssrInterpolate(_ctx.__("list"))}`);
      } else {
        return [
          createVNode(_component_Bars2Icon, { class: "w-5 h-5 mx-1" }),
          createTextVNode(" " + toDisplayString(_ctx.__("list")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("panel.site.new"),
    role: "menuitem",
    class: [$options.subMenuIsActive("panel.site.new"), "flex border-s-2 hover:border-primary-500 items-center p-2 text-sm transition-all duration-200 dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50"]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(ssrRenderComponent(_component_PlusSmallIcon, { class: "w-5 h-5 mx-1" }, null, _parent2, _scopeId));
        _push2(` ${ssrInterpolate(_ctx.__("new"))}`);
      } else {
        return [
          createVNode(_component_PlusSmallIcon, { class: "w-5 h-5 mx-1" }),
          createTextVNode(" " + toDisplayString(_ctx.__("new")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`</li></ul></li><li class="relative text-primary-500"><a class="${ssrRenderClass([{ "bg-primary-50 text-primary-500": $options.menuIsActive("panel.text.*") }, "flex cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"])}" data-te-sidenav-link-ref>`);
  _push(ssrRenderComponent(_component_PencilSquareIcon, { class: "w-5 h-5" }, null, _parent));
  _push(`<span class="mx-2 text-sm">${ssrInterpolate(_ctx.__("texts"))}</span><span class="right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&amp;&gt;svg]:text-gray-600 dark:[&amp;&gt;svg]:text-gray-300" data-te-sidenav-rotate-icon-ref>`);
  _push(ssrRenderComponent(_component_ChevronDownIcon, { class: "h-5 w-5" }, null, _parent));
  _push(`</span></a><ul${ssrRenderAttrs(mergeProps({ "data-te-collapse-show": $options.menuIsActive("panel.text.*") ? true : null }, {
    class: "!visible relative m-0 hidden list-none data-[te-collapse-show]:block",
    "data-te-collapse-item": "",
    "data-te-sidenav-collapse-ref": ""
  }))}><li class="relative ps-7">`);
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("panel.text.index"),
    role: "menuitem",
    class: [$options.subMenuIsActive("panel.text.index"), "flex border-s-2 hover:border-primary-500 items-center p-2 text-sm transition-all duration-200 dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50"]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(ssrRenderComponent(_component_Bars2Icon, { class: "w-5 h-5 mx-1" }, null, _parent2, _scopeId));
        _push2(` ${ssrInterpolate(_ctx.__("list"))}`);
      } else {
        return [
          createVNode(_component_Bars2Icon, { class: "w-5 h-5 mx-1" }),
          createTextVNode(" " + toDisplayString(_ctx.__("list")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("panel.text.new"),
    role: "menuitem",
    class: [$options.subMenuIsActive("panel.text.new"), "flex border-s-2 hover:border-primary-500 items-center p-2 text-sm transition-all duration-200 dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50"]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(ssrRenderComponent(_component_PlusSmallIcon, { class: "w-5 h-5 mx-1" }, null, _parent2, _scopeId));
        _push2(` ${ssrInterpolate(_ctx.__("new"))}`);
      } else {
        return [
          createVNode(_component_PlusSmallIcon, { class: "w-5 h-5 mx-1" }),
          createTextVNode(" " + toDisplayString(_ctx.__("new")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`</li></ul></li><li class="relative text-primary-500"><a class="${ssrRenderClass([{ "bg-primary-50 text-primary-500": $options.menuIsActive("panel.image.*") }, "flex cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"])}" data-te-sidenav-link-ref>`);
  _push(ssrRenderComponent(_component_PhotoIcon, { class: "w-5 h-5" }, null, _parent));
  _push(`<span class="mx-2 text-sm">${ssrInterpolate(_ctx.__("images"))}</span><span class="right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&amp;&gt;svg]:text-gray-600 dark:[&amp;&gt;svg]:text-gray-300" data-te-sidenav-rotate-icon-ref>`);
  _push(ssrRenderComponent(_component_ChevronDownIcon, { class: "h-5 w-5" }, null, _parent));
  _push(`</span></a><ul${ssrRenderAttrs(mergeProps({ "data-te-collapse-show": $options.menuIsActive("panel.image.*") ? true : null }, {
    class: "!visible relative m-0 hidden list-none data-[te-collapse-show]:block",
    "data-te-collapse-item": "",
    "data-te-sidenav-collapse-ref": ""
  }))}><li class="relative ps-7">`);
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("panel.image.index"),
    role: "menuitem",
    class: [$options.subMenuIsActive("panel.image.index"), "flex border-s-2 hover:border-primary-500 items-center p-2 text-sm transition-all duration-200 dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50"]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(ssrRenderComponent(_component_Bars2Icon, { class: "w-5 h-5 mx-1" }, null, _parent2, _scopeId));
        _push2(` ${ssrInterpolate(_ctx.__("list"))}`);
      } else {
        return [
          createVNode(_component_Bars2Icon, { class: "w-5 h-5 mx-1" }),
          createTextVNode(" " + toDisplayString(_ctx.__("list")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("panel.image.new"),
    role: "menuitem",
    class: [$options.subMenuIsActive("panel.image.new"), "flex border-s-2 hover:border-primary-500 items-center p-2 text-sm transition-all duration-200 dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50"]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(ssrRenderComponent(_component_PlusSmallIcon, { class: "w-5 h-5 mx-1" }, null, _parent2, _scopeId));
        _push2(` ${ssrInterpolate(_ctx.__("new"))}`);
      } else {
        return [
          createVNode(_component_PlusSmallIcon, { class: "w-5 h-5 mx-1" }),
          createTextVNode(" " + toDisplayString(_ctx.__("new")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`</li></ul></li><li class="relative text-primary-500"><a class="${ssrRenderClass([{ "bg-primary-50 text-primary-500": $options.menuIsActive("panel.video.*") }, "flex cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"])}" data-te-sidenav-link-ref>`);
  _push(ssrRenderComponent(_component_FilmIcon, { class: "w-5 h-5" }, null, _parent));
  _push(`<span class="mx-2 text-sm">${ssrInterpolate(_ctx.__("videos"))}</span><span class="right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&amp;&gt;svg]:text-gray-600 dark:[&amp;&gt;svg]:text-gray-300" data-te-sidenav-rotate-icon-ref>`);
  _push(ssrRenderComponent(_component_ChevronDownIcon, { class: "h-5 w-5" }, null, _parent));
  _push(`</span></a><ul${ssrRenderAttrs(mergeProps({ "data-te-collapse-show": $options.menuIsActive("panel.video.*") ? true : null }, {
    class: "!visible relative m-0 hidden list-none data-[te-collapse-show]:block",
    "data-te-collapse-item": "",
    "data-te-sidenav-collapse-ref": ""
  }))}><li class="relative ps-7">`);
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("panel.video.index"),
    role: "menuitem",
    class: [$options.subMenuIsActive("panel.video.index"), "flex border-s-2 hover:border-primary-500 items-center p-2 text-sm transition-all duration-200 dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50"]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(ssrRenderComponent(_component_Bars2Icon, { class: "w-5 h-5 mx-1" }, null, _parent2, _scopeId));
        _push2(` ${ssrInterpolate(_ctx.__("list"))}`);
      } else {
        return [
          createVNode(_component_Bars2Icon, { class: "w-5 h-5 mx-1" }),
          createTextVNode(" " + toDisplayString(_ctx.__("list")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("panel.video.new"),
    role: "menuitem",
    class: [$options.subMenuIsActive("panel.video.new"), "flex border-s-2 hover:border-primary-500 items-center p-2 text-sm transition-all duration-200 dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50"]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(ssrRenderComponent(_component_PlusSmallIcon, { class: "w-5 h-5 mx-1" }, null, _parent2, _scopeId));
        _push2(` ${ssrInterpolate(_ctx.__("new"))}`);
      } else {
        return [
          createVNode(_component_PlusSmallIcon, { class: "w-5 h-5 mx-1" }),
          createTextVNode(" " + toDisplayString(_ctx.__("new")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`</li></ul></li><li class="relative text-primary-500"><a class="${ssrRenderClass([{ "bg-primary-50 text-primary-500": $options.menuIsActive("panel.podcast.*") }, "flex cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"])}" data-te-sidenav-link-ref>`);
  _push(ssrRenderComponent(_component_MicrophoneIcon, { class: "w-5 h-5" }, null, _parent));
  _push(`<span class="mx-2 text-sm">${ssrInterpolate(_ctx.__("podcasts"))}</span><span class="right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&amp;&gt;svg]:text-gray-600 dark:[&amp;&gt;svg]:text-gray-300" data-te-sidenav-rotate-icon-ref>`);
  _push(ssrRenderComponent(_component_ChevronDownIcon, { class: "h-5 w-5" }, null, _parent));
  _push(`</span></a><ul${ssrRenderAttrs(mergeProps({ "data-te-collapse-show": $options.menuIsActive("panel.podcast.*") ? true : null }, {
    class: "!visible relative m-0 hidden list-none data-[te-collapse-show]:block",
    "data-te-collapse-item": "",
    "data-te-sidenav-collapse-ref": ""
  }))}><li class="relative ps-7">`);
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("panel.podcast.index"),
    role: "menuitem",
    class: [$options.subMenuIsActive("panel.podcast.index"), "flex border-s-2 hover:border-primary-500 items-center p-2 text-sm transition-all duration-200 dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50"]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(ssrRenderComponent(_component_Bars2Icon, { class: "w-5 h-5 mx-1" }, null, _parent2, _scopeId));
        _push2(` ${ssrInterpolate(_ctx.__("list"))}`);
      } else {
        return [
          createVNode(_component_Bars2Icon, { class: "w-5 h-5 mx-1" }),
          createTextVNode(" " + toDisplayString(_ctx.__("list")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("panel.podcast.new"),
    role: "menuitem",
    class: [$options.subMenuIsActive("panel.podcast.new"), "flex border-s-2 hover:border-primary-500 items-center p-2 text-sm transition-all duration-200 dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50"]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(ssrRenderComponent(_component_PlusSmallIcon, { class: "w-5 h-5 mx-1" }, null, _parent2, _scopeId));
        _push2(` ${ssrInterpolate(_ctx.__("new"))}`);
      } else {
        return [
          createVNode(_component_PlusSmallIcon, { class: "w-5 h-5 mx-1" }),
          createTextVNode(" " + toDisplayString(_ctx.__("new")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`</li></ul></li><li class="relative text-primary-500"><a class="${ssrRenderClass([{ "bg-primary-50 text-primary-500": $options.menuIsActive("panel.auction.*") }, "flex cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"])}" data-te-sidenav-link-ref>`);
  _push(ssrRenderComponent(_component_MegaphoneIcon, { class: "w-5 h-5" }, null, _parent));
  _push(`<span class="mx-2 text-sm">${ssrInterpolate(_ctx.__("auctions"))}</span><span class="right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&amp;&gt;svg]:text-gray-600 dark:[&amp;&gt;svg]:text-gray-300" data-te-sidenav-rotate-icon-ref>`);
  _push(ssrRenderComponent(_component_ChevronDownIcon, { class: "h-5 w-5" }, null, _parent));
  _push(`</span></a><ul${ssrRenderAttrs(mergeProps({ "data-te-collapse-show": $options.menuIsActive("panel.auction.*") ? true : null }, {
    class: "!visible relative m-0 hidden list-none data-[te-collapse-show]:block",
    "data-te-collapse-item": "",
    "data-te-sidenav-collapse-ref": ""
  }))}><li class="relative ps-7">`);
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("panel.auction.index"),
    role: "menuitem",
    class: [$options.subMenuIsActive("panel.auction.index"), "flex border-s-2 hover:border-primary-500 items-center p-2 text-sm transition-all duration-200 dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50"]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(ssrRenderComponent(_component_Bars2Icon, { class: "w-5 h-5 mx-1" }, null, _parent2, _scopeId));
        _push2(` ${ssrInterpolate(_ctx.__("list"))}`);
      } else {
        return [
          createVNode(_component_Bars2Icon, { class: "w-5 h-5 mx-1" }),
          createTextVNode(" " + toDisplayString(_ctx.__("list")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("panel.auction.new"),
    role: "menuitem",
    class: [$options.subMenuIsActive("panel.auction.new"), "flex border-s-2 hover:border-primary-500 items-center p-2 text-sm transition-all duration-200 dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50"]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(ssrRenderComponent(_component_PlusSmallIcon, { class: "w-5 h-5 mx-1" }, null, _parent2, _scopeId));
        _push2(` ${ssrInterpolate(_ctx.__("new"))}`);
      } else {
        return [
          createVNode(_component_PlusSmallIcon, { class: "w-5 h-5 mx-1" }),
          createTextVNode(" " + toDisplayString(_ctx.__("new")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`</li></ul></li><li class="relative text-primary-500"><a class="${ssrRenderClass([{ "bg-primary-50 text-primary-500": $options.menuIsActive("panel.ticket.*") }, "flex cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"])}" data-te-sidenav-link-ref>`);
  _push(ssrRenderComponent(_component_LightBulbIcon, { class: "w-5 h-5" }, null, _parent));
  _push(`<span class="mx-2 text-sm">${ssrInterpolate(_ctx.__("support"))}</span><span class="right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&amp;&gt;svg]:text-gray-600 dark:[&amp;&gt;svg]:text-gray-300" data-te-sidenav-rotate-icon-ref>`);
  _push(ssrRenderComponent(_component_ChevronDownIcon, { class: "h-5 w-5" }, null, _parent));
  _push(`</span></a><ul${ssrRenderAttrs(mergeProps({ "data-te-collapse-show": $options.menuIsActive("panel.ticket.*") ? true : null }, {
    class: "!visible relative m-0 hidden list-none data-[te-collapse-show]:block",
    "data-te-collapse-item": "",
    "data-te-sidenav-collapse-ref": ""
  }))}><li class="relative ps-7">`);
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("panel.ticket.index"),
    role: "menuitem",
    class: [$options.subMenuIsActive("panel.ticket.index"), "flex border-s-2 hover:border-primary-500 items-center p-2 text-sm transition-all duration-200 dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50"]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(ssrRenderComponent(_component_Bars2Icon, { class: "w-5 h-5 mx-1" }, null, _parent2, _scopeId));
        _push2(` ${ssrInterpolate(_ctx.__("tickets"))}`);
      } else {
        return [
          createVNode(_component_Bars2Icon, { class: "w-5 h-5 mx-1" }),
          createTextVNode(" " + toDisplayString(_ctx.__("tickets")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("panel.ticket.new"),
    role: "menuitem",
    class: [$options.subMenuIsActive("panel.ticket.new"), "flex border-s-2 hover:border-primary-500 items-center p-2 text-sm transition-all duration-200 dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50"]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(ssrRenderComponent(_component_PlusSmallIcon, { class: "w-5 h-5 mx-1" }, null, _parent2, _scopeId));
        _push2(` ${ssrInterpolate(_ctx.__("new_ticket"))}`);
      } else {
        return [
          createVNode(_component_PlusSmallIcon, { class: "w-5 h-5 mx-1" }),
          createTextVNode(" " + toDisplayString(_ctx.__("new_ticket")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`</li></ul></li><li class="relative text-primary-500"><a class="${ssrRenderClass([{ "bg-primary-50 text-primary-500": $options.menuIsActive("panel.financial.*") }, "flex cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"])}" data-te-sidenav-link-ref>`);
  _push(ssrRenderComponent(_component_CurrencyDollarIcon, { class: "w-5 h-5" }, null, _parent));
  _push(`<span class="mx-2 text-sm">${ssrInterpolate(_ctx.__("financial"))}</span><span class="right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&amp;&gt;svg]:text-gray-600 dark:[&amp;&gt;svg]:text-gray-300" data-te-sidenav-rotate-icon-ref>`);
  _push(ssrRenderComponent(_component_ChevronDownIcon, { class: "h-5 w-5" }, null, _parent));
  _push(`</span></a><ul${ssrRenderAttrs(mergeProps({ "data-te-collapse-show": $options.menuIsActive("panel.financial.*") ? true : null }, {
    class: "!visible relative m-0 hidden list-none data-[te-collapse-show]:block",
    "data-te-collapse-item": "",
    "data-te-sidenav-collapse-ref": ""
  }))}><li class="relative ps-7">`);
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("panel.financial.transaction.index"),
    role: "menuitem",
    class: [$options.subMenuIsActive("panel.financial.transaction.index"), "flex border-s-2 hover:border-primary-500 items-center p-2 text-sm transition-all duration-200 dark:text-light dark:hover:text-light hover:text-primary-700 hover:bg-primary-50"]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(ssrRenderComponent(_component_Bars2Icon, { class: "w-5 h-5 mx-1" }, null, _parent2, _scopeId));
        _push2(` ${ssrInterpolate(_ctx.__("transactions"))}`);
      } else {
        return [
          createVNode(_component_Bars2Icon, { class: "w-5 h-5 mx-1" }),
          createTextVNode(" " + toDisplayString(_ctx.__("transactions")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`</li></ul></li><li><div class="py-4"></div></li></ul></nav></aside><div class="flex-1 h-full overflow-x-hidden overflow-y-auto"><header class="relative bg-white dark:bg-darker"><div class="flex items-center justify-between p-2 border-b dark:border-primary-darker"><button class="p-1 transition-colors duration-200 rounded-md text-primary-lighter bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark md:hidden focus:outline-none focus:ring"><span class="sr-only">Open main manu</span><span aria-hidden="true"><svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg></span></button>`);
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("/"),
    class: "inline-block text-2xl font-bold tracking-wider text-primary-500 dark:text-light"
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`${ssrInterpolate(_ctx.__("app_name"))}`);
      } else {
        return [
          createTextVNode(toDisplayString(_ctx.__("app_name")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`<nav aria-label="Secondary" class="p-1 space-x-2 flex items-center">`);
  {
    _push(`<!---->`);
  }
  _push(`<button class="relative p-1 mx-2 transition-colors duration-200 rounded-full text-primary-500 bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark focus:outline-none focus:bg-primary-100 dark:focus:bg-primary-dark focus:ring-primary-darker"><span class="sr-only">Open Notification panel</span>`);
  if (_ctx.$page.props.auth.user.notifications > 0) {
    _push(`<span class="bg-red-500 rounded-full p-[.3rem] absolute top-0 start-0 animate-pulse"></span>`);
  } else {
    _push(`<!---->`);
  }
  _push(`<svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg></button><button class="p-1 transition-colors duration-200 rounded-full text-primary-500 bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark focus:outline-none focus:bg-primary-100 dark:focus:bg-primary-dark focus:ring-primary-darker"><span class="sr-only">Open settings panel</span><svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg></button><div class="relative flex"><button class="transition-colors duration-200 rounded-full text-primary-500 bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark focus:outline-none focus:bg-primary-100 dark:focus:bg-primary-dark focus:ring-primary-darker"><span class="sr-only">User menu</span>`);
  _push(ssrRenderComponent(_component_Image, {
    classes: "    object-cover   rounded-full w-8 h-8  ",
    src: "https://images.unsplash.com/photo-1523779917675-b6ed3a42a561?ixid=MnwxMjA3fDB8MHxzZWFyY2h8N3x8d29tYW4lMjBibHVlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=face&w=500&q=200",
    alt: "jane avatar",
    type: "user"
  }, null, _parent));
  _push(`</button><div class="absolute right-0 w-48 py-1 bg-white rounded-md shadow-lg top-12 ring-1 ring-black ring-opacity-5 dark:bg-dark focus:outline-none" tabindex="-1" role="menu" aria-orientation="vertical" aria-label="User menu" style="${ssrRenderStyle({ "display": "none" })}"><a href="#" role="menuitem" class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary"> Your Profile </a><a href="#" role="menuitem" class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary"> Settings </a><a href="#" role="menuitem" class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary"> Logout </a></div></div></nav></div><div class="border-b md:hidden dark:border-primary-darker" style="${ssrRenderStyle([
    $data.isMobileMainMenuOpen ? null : { display: "none" },
    { "display": "none" }
  ])}"><nav aria-label="Main" class="px-2 py-4 space-y-2"></nav></div></header><main class="min-h-screen text-primary-500">`);
  ssrRenderSlot(_ctx.$slots, "content", {}, null, _push, _parent);
  _push(`</main><footer class="flex shadow-lg drop-shadow items-center justify-between p-4 bg-white dark:bg-darker dark:border-primary-darker"><div><a href="https://zil.ink/varta" target="_blank" class="text-blue-500 hover:underline"></a></div><div>${ssrInterpolate(_ctx.__("app_name"))} ${ssrInterpolate((/* @__PURE__ */ new Date()).toLocaleDateString("GMT", { year: "numeric" }))}</div></footer></div></div></main>`);
}
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/God/Panel.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const Panel = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  Panel as default
};
