import { Head, Link } from "@inertiajs/vue3";
import "vue-plugin-load-script";
import { HomeIcon, ChevronDownIcon, Bars3Icon, PlusSmallIcon, Bars2Icon, NewspaperIcon, WindowIcon, GlobeAltIcon, PencilSquareIcon, PhotoIcon, FilmIcon, MicrophoneIcon, MegaphoneIcon, LightBulbIcon, CurrencyDollarIcon, BellAlertIcon, Cog6ToothIcon, ArrowRightOnRectangleIcon } from "@heroicons/vue/24/outline";
import { I as Image } from "./Image-0110566e.mjs";
import { initTE, Sidenav } from "tw-elements";
import { resolveComponent, mergeProps, withCtx, renderSlot, createVNode, toDisplayString, createTextVNode, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrRenderComponent, ssrRenderSlot, ssrInterpolate, ssrRenderClass, ssrRenderStyle } from "vue/server-renderer";
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
      isOpen: { "business": false, "article": false },
      user: this.$page.props.auth.user
    };
  },
  props: [],
  created() {
  },
  mounted() {
    initTE({ Sidenav });
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
      return new Promise((resolve) => setTimeout(resolve, time));
    },
    menuIsActive(link) {
      return this.route().current(`${link}`);
    },
    subMenuIsActive(link) {
      return this.route().current(`${link}`) ? "text-primary-700 border-s border-primary-500  " : "text-gray-500   ";
    }
  }
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_Head = resolveComponent("Head");
  const _component_Link = resolveComponent("Link");
  const _component_HomeIcon = resolveComponent("HomeIcon");
  const _component_ChevronDownIcon = resolveComponent("ChevronDownIcon");
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
  const _component_BellAlertIcon = resolveComponent("BellAlertIcon");
  const _component_Cog6ToothIcon = resolveComponent("Cog6ToothIcon");
  const _component_Image = resolveComponent("Image");
  const _component_ArrowRightOnRectangleIcon = resolveComponent("ArrowRightOnRectangleIcon");
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
  _push(`<aside class="flex-shrink-0 shadow-lg hidden w-60 bg-white dark:border-primary md:block"><nav id="sidenav-2" class="fixed start-0 top-0 z-[1035] h-screen w-60 -translate-x-full overflow-hidden bg-white data-[te-sidenav-hidden=&#39;false&#39;]:translate-x-0 dark:bg-zinc-800" data-te-sidenav-init data-te-sidenav-hidden="false" data-te-sidenav-mode="side" data-te-sidenav-right="true" data-te-sidenav-content="#content"><ul class="relative m-0 list-none text-primary-500" data-te-sidenav-menu-ref><li class="relative">`);
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("panel.index"),
    class: ["py-4 flex text-center outline-none transition duration-300 ease-linear hover:bg-slate-200 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10", { "bg-primary-100 text-primary-500": $options.menuIsActive("panel.index") }]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`<span class="w-full"${_scopeId}>${ssrInterpolate(_ctx.__("dashboard"))}</span>`);
      } else {
        return [
          createVNode("span", { class: "w-full" }, toDisplayString(_ctx.__("dashboard")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`</li><li class="relative"><a class="${ssrRenderClass([{ "bg-primary-50 text-primary-500": $options.menuIsActive("panel.business.*") }, "flex cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-primary-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"])}" data-te-sidenav-link-ref>`);
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
  _push(`</li></ul></li><li class="relative"><a class="${ssrRenderClass([{ "bg-primary-50 text-primary-500": $options.menuIsActive("panel.article.*") }, "flex cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-primary-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"])}" data-te-sidenav-link-ref>`);
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
  _push(`</li></ul></li><li class="relative"><a class="${ssrRenderClass([{ "bg-primary-50 text-primary-500": $options.menuIsActive("panel.site.*") }, "flex cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-primary-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"])}" data-te-sidenav-link-ref>`);
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
  _push(`</li></ul></li><li class="relative"><a class="${ssrRenderClass([{ "bg-primary-50 text-primary-500": $options.menuIsActive("panel.text.*") }, "flex cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-primary-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"])}" data-te-sidenav-link-ref>`);
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
  _push(`</li></ul></li><li class="relative"><a class="${ssrRenderClass([{ "bg-primary-50 text-primary-500": $options.menuIsActive("panel.image.*") }, "flex cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-primary-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"])}" data-te-sidenav-link-ref>`);
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
  _push(`</li></ul></li><li class="relative"><a class="${ssrRenderClass([{ "bg-primary-50 text-primary-500": $options.menuIsActive("panel.video.*") }, "flex cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-primary-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"])}" data-te-sidenav-link-ref>`);
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
  _push(`</li></ul></li><li class="relative"><a class="${ssrRenderClass([{ "bg-primary-50 text-primary-500": $options.menuIsActive("panel.podcast.*") }, "flex cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-primary-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"])}" data-te-sidenav-link-ref>`);
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
  _push(`</li></ul></li><li class="relative"><a class="${ssrRenderClass([{ "bg-primary-50 text-primary-500": $options.menuIsActive("panel.auction.*") }, "flex cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-primary-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"])}" data-te-sidenav-link-ref>`);
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
  _push(`</li></ul></li><li class="relative"><a class="${ssrRenderClass([{ "bg-primary-50 text-primary-500": $options.menuIsActive("panel.ticket.*") }, "flex cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-primary-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"])}" data-te-sidenav-link-ref>`);
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
  _push(`</li></ul></li><li class="relative"><a class="${ssrRenderClass([{ "bg-primary-50 text-primary-500": $options.menuIsActive("panel.financial.*") }, "flex cursor-pointer items-center truncate rounded-[5px] px-3 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-primary-100 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"])}" data-te-sidenav-link-ref>`);
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
  _push(`<nav aria-label="Secondary" class="p-1 flex items-center">`);
  {
    _push(`<!---->`);
  }
  _push(`<div class="relative mx-1" data-te-dropdown-ref><button class="flex p-1 items-center whitespace-nowrap rounded bg-primary rounded-full text-primary-500 bg-primary-50 hover:text-primary hover:bg-primary-100 text-xs font-medium leading-normal transition duration-150 ease-in-out hover:shadow-lg focus:bg-primary-200 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-200 active:shadow-lg motion-reduce:transition-none dark:shadow-lg dark:hover:shadow-lg dark:focus:shadow-lg" type="button" id="dropdownNotidicationSetting" data-te-dropdown-toggle-ref aria-expanded="false" data-te-ripple-init data-te-ripple-color="light"><span class="sr-only">Open notidications panel</span>`);
  if (_ctx.$page.props.auth.user.notifications > 0) {
    _push(`<span class="bg-red-500 rounded-full text-white px-[.3rem] absolute top-0 start-0">${ssrInterpolate(_ctx.$page.props.auth.user.notifications)}</span>`);
  } else {
    _push(`<!---->`);
  }
  _push(ssrRenderComponent(_component_BellAlertIcon, { class: "w-7 h-7" }, null, _parent));
  _push(`</button><ul class="absolute z-[1000] float-start m-0 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-start text-base shadow-lg dark:bg-neutral-700 [&amp;[data-te-dropdown-show]]:block" aria-labelledby="dropdownNotidicationSetting" data-te-dropdown-menu-ref><li><a class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-neutral-600" href="#" data-te-dropdown-item-ref>Action</a></li></ul></div><div class="relative mx-1" data-te-dropdown-ref><button class="flex p-1 items-center whitespace-nowrap rounded bg-primary rounded-full text-primary-500 bg-primary-50 hover:text-primary hover:bg-primary-100 text-xs font-medium leading-normal transition duration-150 ease-in-out hover:shadow-lg focus:bg-primary-200 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-200 active:shadow-lg motion-reduce:transition-none dark:shadow-lg dark:hover:shadow-lg dark:focus:shadow-lg" type="button" id="dropdownMenuSetting" data-te-dropdown-toggle-ref aria-expanded="false" data-te-ripple-init data-te-ripple-color="light"><span class="sr-only">Open settings panel</span>`);
  _push(ssrRenderComponent(_component_Cog6ToothIcon, { class: "w-7 h-7" }, null, _parent));
  _push(`</button><ul class="absolute z-[1000] float-start m-0 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-start text-base shadow-lg dark:bg-neutral-700 [&amp;[data-te-dropdown-show]]:block" aria-labelledby="dropdownMenuSetting" data-te-dropdown-menu-ref><li><a class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-neutral-600" href="#" data-te-dropdown-item-ref>Action</a></li></ul></div><div class="relative mx-1" data-te-dropdown-ref><button id="dropdownUserSetting" data-te-dropdown-toggle-ref aria-expanded="false" data-te-ripple-init data-te-ripple-color="light" class="flex transition-colors duration-200 rounded-full text-primary-500 bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark focus:outline-none focus:bg-primary-100 dark:focus:bg-primary-dark focus:ring-primary-darker"><span class="sr-only">User menu</span>`);
  _push(ssrRenderComponent(_component_Image, {
    classes: "  hover:shadow-lg  object-cover   rounded-full w-8 h-8  ",
    src: "https://images.unsplash.com/photo-1523779917675-b6ed3a42a561?ixid=MnwxMjA3fDB8MHxzZWFyY2h8N3x8d29tYW4lMjBibHVlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=face&w=500&q=200",
    alt: "jane avatar",
    type: "user"
  }, null, _parent));
  _push(`</button><div data-te-dropdown-menu-ref class="min-w-[12rem] absolute z-[1000] float-start m-0 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-start text-base shadow-lg dark:bg-neutral-700 [&amp;[data-te-dropdown-show]]:block" tabindex="-1" role="menu" aria-orientation="vertical" aria-label="User menu" aria-labelledby="dropdownUserSetting">`);
  _push(ssrRenderComponent(_component_Link, {
    href: "#",
    role: "menuitem",
    class: "block p-4 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary"
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`${ssrInterpolate(_ctx.__("profile_setting"))}`);
      } else {
        return [
          createTextVNode(toDisplayString(_ctx.__("profile_setting")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`<hr class="border-gray-200 dark:border-gray-700"><a href="#" role="menuitem" class="block p-4 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary">${ssrInterpolate(_ctx.__("change_password"))}</a><hr class="border-gray-200 dark:border-gray-700">`);
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("logout"),
    class: "flex"
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`<button class="flex items-center justify-center p-4 m-3 w-full hover:scale-110 focus:outline-none px-4 py-2 rounded font-bold cursor-pointer hover:bg-red-700 hover:text-red-100 bg-red-100 text-red-500 border duration-200 ease-in-out border-red-600"${_scopeId}>${ssrInterpolate(_ctx.__("signout"))} `);
        _push2(ssrRenderComponent(_component_ArrowRightOnRectangleIcon, { class: "h-5 w-5 text-red-500" }, null, _parent2, _scopeId));
        _push2(`</button>`);
      } else {
        return [
          createVNode("button", { class: "flex items-center justify-center p-4 m-3 w-full hover:scale-110 focus:outline-none px-4 py-2 rounded font-bold cursor-pointer hover:bg-red-700 hover:text-red-100 bg-red-100 text-red-500 border duration-200 ease-in-out border-red-600" }, [
            createTextVNode(toDisplayString(_ctx.__("signout")) + " ", 1),
            createVNode(_component_ArrowRightOnRectangleIcon, { class: "h-5 w-5 text-red-500" })
          ])
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`</div></div></nav></div><div class="border-b md:hidden dark:border-primary-darker" style="${ssrRenderStyle([
    $data.isMobileMainMenuOpen ? null : { display: "none" },
    { "display": "none" }
  ])}"><nav aria-label="Main" class="px-2 py-4 space-y-2"></nav></div></header><main class="min-h-screen text-primary-500">`);
  ssrRenderSlot(_ctx.$slots, "content", {}, null, _push, _parent);
  _push(`</main><footer class="flex shadow-lg drop-shadow items-center justify-between p-4 bg-white dark:bg-darker dark:border-primary-darker"><div><a href="https://zil.ink/varta" target="_blank" class="text-blue-500 hover:underline"></a></div><div>${ssrInterpolate(_ctx.__("app_name"))} ${ssrInterpolate((/* @__PURE__ */ new Date()).toLocaleDateString("GMT", { year: "numeric" }))}</div></footer></div></div></main>`);
}
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Layouts/Panel.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const Panel = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  Panel as P
};
