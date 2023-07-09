import { Link, Head } from "@inertiajs/vue3";
import { useSSRContext, resolveComponent, mergeProps, withCtx, openBlock, createBlock, createVNode, createTextVNode, toDisplayString, defineComponent, renderSlot } from "vue";
import { ssrRenderAttrs, ssrRenderComponent, ssrRenderClass, ssrInterpolate, ssrRenderAttr, ssrRenderSlot } from "vue/server-renderer";
import { _ as _export_sfc } from "./_plugin-vue_export-helper-cc2b3d55.mjs";
import { UserIcon, ChevronDownIcon, ArrowRightOnRectangleIcon, Bars3Icon } from "@heroicons/vue/24/outline";
import { I as Image } from "./Image-0110566e.mjs";
import { A as ApplicationLogo } from "./ApplicationLogo-7135a78a.mjs";
const _sfc_main$4 = {
  components: { Link },
  props: {},
  setup(props) {
  },
  computed: {
    selectable_locale() {
      if (this.$page.locale == "fa") {
        return "en";
      }
      if (this.$page.locale == "en") {
        return "ar";
      }
      return "fa";
    }
  }
};
function _sfc_ssrRender$4(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_Link = resolveComponent("Link");
  _push(`<div${ssrRenderAttrs(mergeProps({ class: "" }, _attrs))}>`);
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("language", [$options.selectable_locale]),
    class: "flex mx-1 border-2 text-primary-500 bg-primary-100 hover:bg-primary-200 border-transparent text-sm font-medium leading-5 focus:outline-none focus:text-gray-700 focus:border- gray-300 transition duration-300 ease-in-out border-primary-500 p-2 rounded-lg"
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        if ($options.selectable_locale == "fa") {
          _push2(`<div class=""${_scopeId}>Fa</div>`);
        } else if ($options.selectable_locale == "ar") {
          _push2(`<div${_scopeId}>AR</div>`);
        } else {
          _push2(`<div${_scopeId}>EN</div>`);
        }
      } else {
        return [
          $options.selectable_locale == "fa" ? (openBlock(), createBlock("div", {
            key: 0,
            class: ""
          }, "Fa")) : $options.selectable_locale == "ar" ? (openBlock(), createBlock("div", { key: 1 }, "AR")) : (openBlock(), createBlock("div", { key: 2 }, "EN"))
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`</div>`);
}
const _sfc_setup$4 = _sfc_main$4.setup;
_sfc_main$4.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/LanguageButton.vue");
  return _sfc_setup$4 ? _sfc_setup$4(props, ctx) : void 0;
};
const LanguageButton = /* @__PURE__ */ _export_sfc(_sfc_main$4, [["ssrRender", _sfc_ssrRender$4]]);
const UserButton_vue_vue_type_style_index_0_scoped_68d63406_lang = "";
const _sfc_main$3 = {
  data() {
    return { chevronRotate: false, chevronShow: false };
  },
  components: { Link, UserIcon, ChevronDownIcon, Image, ArrowRightOnRectangleIcon },
  props: {},
  setup(props) {
  },
  computed: {
    selectable_locale() {
      if (this.$page.locale == "fa") {
        return "en";
      }
      if (this.$page.locale == "en") {
        return "ar";
      }
      return "fa";
    }
  },
  watch: {},
  methods: {
    profileLink() {
      if (this.$page.props.auth.user)
        return this.route("panel.index");
      else
        return this.route("login");
    }
  }
};
function _sfc_ssrRender$3(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_ChevronDownIcon = resolveComponent("ChevronDownIcon");
  const _component_Link = resolveComponent("Link");
  const _component_Image = resolveComponent("Image");
  const _component_ArrowRightOnRectangleIcon = resolveComponent("ArrowRightOnRectangleIcon");
  const _component_UserIcon = resolveComponent("UserIcon");
  _push(`<div${ssrRenderAttrs(mergeProps({ class: "flex items-center" }, _attrs))} data-v-68d63406>`);
  if (_ctx.$page.props.auth.user) {
    _push(`<div data-v-68d63406><div class="group flex relative dropdown text-start" data-v-68d63406><button class="relative z-10 flex items-center p-2 text-sm text-gray-600 bg-white border border-transparent rounded-md focus:border-blue-500 focus:ring-opacity-40 dark:focus:ring-opacity-40 focus:ring-blue-300 dark:focus:ring-blue-400 focus:ring dark:text-white dark:bg-gray-800 focus:outline-none" data-v-68d63406><span class="${ssrRenderClass([$data.chevronRotate ? "rotate-90" : "", "transition duration-500"])}" data-v-68d63406>`);
    _push(ssrRenderComponent(_component_ChevronDownIcon, { class: "h-5 w-5" }, null, _parent));
    _push(`</span><span class="mx-1" data-v-68d63406>Jane Doe</span></button>`);
    if ($data.chevronShow) {
      _push(`<ul class="flex-col bg-white border shadow-xl rounded-lg transform scale-0 group-hover:scale-100 absolute end-0 top-10 transition duration-200 ease-in-out origin-top overflow-hidden" data-v-68d63406>`);
      _push(ssrRenderComponent(_component_Link, {
        href: "#",
        class: "flex px-6 py-4 justify-around text-sm text-gray-600 transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"
      }, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(ssrRenderComponent(_component_Image, {
              classes: " flex-shrink-0  object-cover mx-1 rounded-full w-9 h-9",
              src: "https://images.unsplash.com/photo-1523779917675-b6ed3a42a561?ixid=MnwxMjA3fDB8MHxzZWFyY2h8N3x8d29tYW4lMjBibHVlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=face&w=500&q=200",
              alt: "jane avatar",
              type: "user"
            }, null, _parent2, _scopeId));
            _push2(`<div class="flex-col mx-1" data-v-68d63406${_scopeId}><h1 class="text-sm font-semibold text-gray-700 dark:text-gray-200" data-v-68d63406${_scopeId}>Jane Doe</h1><div class="text-sm text-gray-500 dark:text-gray-400" data-v-68d63406${_scopeId}>janedoe@exampl.com</div></div>`);
          } else {
            return [
              createVNode(_component_Image, {
                classes: " flex-shrink-0  object-cover mx-1 rounded-full w-9 h-9",
                src: "https://images.unsplash.com/photo-1523779917675-b6ed3a42a561?ixid=MnwxMjA3fDB8MHxzZWFyY2h8N3x8d29tYW4lMjBibHVlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=face&w=500&q=200",
                alt: "jane avatar",
                type: "user"
              }),
              createVNode("div", { class: "flex-col mx-1" }, [
                createVNode("h1", { class: "text-sm font-semibold text-gray-700 dark:text-gray-200" }, "Jane Doe"),
                createVNode("div", { class: "text-sm text-gray-500 dark:text-gray-400" }, "janedoe@exampl.com")
              ])
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(`<hr class="border-gray-200 dark:border-gray-700" data-v-68d63406>`);
      _push(ssrRenderComponent(_component_Link, {
        href: _ctx.route("panel.index"),
        class: "flex px-4 py-4 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"
      }, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`${ssrInterpolate(_ctx.__("dashboard"))}`);
          } else {
            return [
              createTextVNode(toDisplayString(_ctx.__("dashboard")), 1)
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(`<hr class="border-gray-200 dark:border-gray-700" data-v-68d63406>`);
      _push(ssrRenderComponent(_component_Link, {
        href: _ctx.route("logout"),
        class: "flex"
      }, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`<button class="flex items-center justify-center p-4 m-3 w-full hover:scale-110 focus:outline-none px-4 py-2 rounded font-bold cursor-pointer hover:bg-red-700 hover:text-red-100 bg-red-100 text-red-500 border duration-200 ease-in-out border-red-600 transition" data-v-68d63406${_scopeId}>${ssrInterpolate(_ctx.__("signout"))} `);
            _push2(ssrRenderComponent(_component_ArrowRightOnRectangleIcon, { class: "h-5 w-5 text-red-500" }, null, _parent2, _scopeId));
            _push2(`</button>`);
          } else {
            return [
              createVNode("button", { class: "flex items-center justify-center p-4 m-3 w-full hover:scale-110 focus:outline-none px-4 py-2 rounded font-bold cursor-pointer hover:bg-red-700 hover:text-red-100 bg-red-100 text-red-500 border duration-200 ease-in-out border-red-600 transition" }, [
                createTextVNode(toDisplayString(_ctx.__("signout")) + " ", 1),
                createVNode(_component_ArrowRightOnRectangleIcon, { class: "h-5 w-5 text-red-500" })
              ])
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(`</ul>`);
    } else {
      _push(`<!---->`);
    }
    _push(`</div></div>`);
  } else {
    _push(`<!---->`);
  }
  _push(ssrRenderComponent(_component_Link, {
    href: $options.profileLink(),
    class: "flex mx-1 border-2 text-white border-transparent font-medium focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-300 ease-in-out border-primary-500 p-2 rounded-lg bg-primary-500 rounded-lg hover:bg-primary-400"
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(ssrRenderComponent(_component_UserIcon, { class: "h-5 w-5" }, null, _parent2, _scopeId));
      } else {
        return [
          createVNode(_component_UserIcon, { class: "h-5 w-5" })
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`</div>`);
}
const _sfc_setup$3 = _sfc_main$3.setup;
_sfc_main$3.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/UserButton.vue");
  return _sfc_setup$3 ? _sfc_setup$3(props, ctx) : void 0;
};
const UserButton = /* @__PURE__ */ _export_sfc(_sfc_main$3, [["ssrRender", _sfc_ssrRender$3], ["__scopeId", "data-v-68d63406"]]);
const Navbar_vue_vue_type_style_index_0_lang = "";
const _sfc_main$2 = {
  components: {
    ApplicationLogo,
    LanguageButton,
    UserButton,
    Bars3Icon,
    UserIcon,
    Link,
    Head
  },
  data() {
    return {};
  },
  mounted() {
    const btn = document.querySelector("button.mobile-menu-button");
    const menu = document.querySelector(".mobile-menu");
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
      if (!this.route().current("/")) {
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
      document.addEventListener("scroll", function() {
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
};
function _sfc_ssrRender$2(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_Link = resolveComponent("Link");
  const _component_ApplicationLogo = resolveComponent("ApplicationLogo");
  const _component_UserButton = resolveComponent("UserButton");
  const _component_LanguageButton = resolveComponent("LanguageButton");
  const _component_Bars3Icon = resolveComponent("Bars3Icon");
  _push(`<nav${ssrRenderAttrs(mergeProps({ class: "fixed w-full z-30 top-0" }, _attrs))}><div class="max-w-6xl mx-auto px-2 lg:px-4"><div class="flex justify-between"><div class="flex space-x-4"><div>`);
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("/"),
    class: "flex items-center py-4 px-2"
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(ssrRenderComponent(_component_ApplicationLogo, { class: "w-9 h-9 fill-current text-primary-600" }, null, _parent2, _scopeId));
        _push2(`<span class="font-semibold text-white nav-item text-lg"${_scopeId}>${ssrInterpolate(_ctx.__("app_name"))}</span>`);
      } else {
        return [
          createVNode(_component_ApplicationLogo, { class: "w-9 h-9 fill-current text-primary-600" }),
          createVNode("span", { class: "font-semibold text-white nav-item text-lg" }, toDisplayString(_ctx.__("app_name")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`</div></div><div class="hidden md:flex items-center grow justify-around text-xs transition-all duration-500"><div class="flex items-center">`);
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("/"),
    class: ["px-4 nav-item", $options.navClasses("/")]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`${ssrInterpolate(_ctx.__("home"))}`);
      } else {
        return [
          createTextVNode(toDisplayString(_ctx.__("home")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("business.index"),
    class: ["nav-item", $options.navClasses("business")]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`${ssrInterpolate(_ctx.__("businesses"))}`);
      } else {
        return [
          createTextVNode(toDisplayString(_ctx.__("businesses")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("article.index"),
    class: ["nav-item", $options.navClasses("article")]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`${ssrInterpolate(_ctx.__("articles"))}`);
      } else {
        return [
          createTextVNode(toDisplayString(_ctx.__("articles")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("video.index"),
    class: ["nav-item", $options.navClasses("video")]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`${ssrInterpolate(_ctx.__("videos"))}`);
      } else {
        return [
          createTextVNode(toDisplayString(_ctx.__("videos")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("podcast.index"),
    class: ["nav-item", $options.navClasses("podcast")]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`${ssrInterpolate(_ctx.__("podcasts"))}`);
      } else {
        return [
          createTextVNode(toDisplayString(_ctx.__("podcasts")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("page.make_money"),
    class: ["nav-item", $options.navClasses("make_money")]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`${ssrInterpolate(_ctx.__("make_money"))}`);
      } else {
        return [
          createTextVNode(toDisplayString(_ctx.__("make_money")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`</div><div class="flex items-center">`);
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("page.prices"),
    class: ["nav-item", $options.navClasses("prices")]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`${ssrInterpolate(_ctx.__("prices"))}`);
      } else {
        return [
          createTextVNode(toDisplayString(_ctx.__("prices")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("page.help"),
    class: ["nav-item", $options.navClasses("help")]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`${ssrInterpolate(_ctx.__("help"))}`);
      } else {
        return [
          createTextVNode(toDisplayString(_ctx.__("help")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("page.contact_us"),
    class: ["nav-item", $options.navClasses("contact_us")]
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`${ssrInterpolate(_ctx.__("contact_us"))}`);
      } else {
        return [
          createTextVNode(toDisplayString(_ctx.__("contact_us")), 1)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`</div></div><div class="flex items-center space-x-3">`);
  _push(ssrRenderComponent(_component_UserButton, null, null, _parent));
  _push(ssrRenderComponent(_component_LanguageButton, null, null, _parent));
  _push(`</div><div class="md:hidden flex items-center nav-item"><button class="h-9 w-9 border-2 rounded mobile-menu-button">`);
  _push(ssrRenderComponent(_component_Bars3Icon, {
    class: "",
    className: "  "
  }, null, _parent));
  _push(`</button></div></div></div><div class="hidden mobile-menu"><ul class=""><li class="active"><a href="index.html" class="block text-sm px-2 py-4 text-white bg-green-500 font-semibold">Home</a></li><li><a href="#services" class="block text-sm px-2 py-4 hover:text-white hover:bg-green-500 transition duration-300">Services</a></li></ul></div></nav>`);
}
const _sfc_setup$2 = _sfc_main$2.setup;
_sfc_main$2.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/Navbar.vue");
  return _sfc_setup$2 ? _sfc_setup$2(props, ctx) : void 0;
};
const Navbar = /* @__PURE__ */ _export_sfc(_sfc_main$2, [["ssrRender", _sfc_ssrRender$2]]);
const _sfc_main$1 = defineComponent({
  components: { ApplicationLogo, Link }
});
function _sfc_ssrRender$1(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_Link = resolveComponent("Link");
  const _component_ApplicationLogo = resolveComponent("ApplicationLogo");
  _push(`<footer${ssrRenderAttrs(mergeProps({ class: "bg-white" }, _attrs))}><div class="container mx-auto px-8"><div class="w-full flex flex-col md:flex-row py-6"><div class="flex-1 mb-6 text-black">`);
  _push(ssrRenderComponent(_component_Link, {
    href: _ctx.route("/"),
    class: "text-pink-600 no-underline hover:no-underline font-bold text-2xl lg:text-4xl"
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(ssrRenderComponent(_component_ApplicationLogo, null, null, _parent2, _scopeId));
      } else {
        return [
          createVNode(_component_ApplicationLogo)
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`</div><div class="flex-1"><p class="uppercase text-gray-500 md:mb-6">Links</p><ul class="list-reset mb-6"><li class="mt-2 inline-block mr-2 md:block md:mr-0"><a href="#" class="no-underline hover:underline text-gray-800 hover:text-pink-500">FAQ</a></li><li class="mt-2 inline-block mr-2 md:block md:mr-0"><a href="#" class="no-underline hover:underline text-gray-800 hover:text-pink-500">Help</a></li><li class="mt-2 inline-block mr-2 md:block md:mr-0"><a href="#" class="no-underline hover:underline text-gray-800 hover:text-pink-500">Support</a></li></ul></div><div class="flex-1"><p class="uppercase text-gray-500 md:mb-6">Legal</p><ul class="list-reset mb-6"><li class="mt-2 inline-block mr-2 md:block md:mr-0"><a href="#" class="no-underline hover:underline text-gray-800 hover:text-pink-500">Terms</a></li><li class="mt-2 inline-block mr-2 md:block md:mr-0"><a href="#" class="no-underline hover:underline text-gray-800 hover:text-pink-500">Privacy</a></li></ul></div><div class="flex-1"><p class="uppercase text-gray-500 md:mb-6">Social</p><ul class="list-reset mb-6"><li class="mt-2 inline-block mr-2 md:block md:mr-0"><a href="#" class="no-underline hover:underline text-gray-800 hover:text-pink-500">Facebook</a></li><li class="mt-2 inline-block mr-2 md:block md:mr-0"><a href="#" class="no-underline hover:underline text-gray-800 hover:text-pink-500">Linkedin</a></li><li class="mt-2 inline-block mr-2 md:block md:mr-0"><a href="#" class="no-underline hover:underline text-gray-800 hover:text-pink-500">Twitter</a></li></ul></div><div class="flex-1"><p class="uppercase text-gray-500 md:mb-6">Company</p><ul class="list-reset mb-6"><li class="mt-2 inline-block mr-2 md:block md:mr-0"><a href="#" class="no-underline hover:underline text-gray-800 hover:text-pink-500">Official Blog</a></li><li class="mt-2 inline-block mr-2 md:block md:mr-0"><a href="#" class="no-underline hover:underline text-gray-800 hover:text-pink-500">About Us</a></li><li class="mt-2 inline-block mr-2 md:block md:mr-0"><a href="#" class="no-underline hover:underline text-gray-800 hover:text-pink-500">Contact</a></li></ul></div></div></div></footer>`);
}
const _sfc_setup$1 = _sfc_main$1.setup;
_sfc_main$1.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/Footer.vue");
  return _sfc_setup$1 ? _sfc_setup$1(props, ctx) : void 0;
};
const Footer = /* @__PURE__ */ _export_sfc(_sfc_main$1, [["ssrRender", _sfc_ssrRender$1]]);
const _sfc_main = {
  components: {
    Head,
    Link,
    Navbar,
    Footer
  }
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_Navbar = resolveComponent("Navbar");
  const _component_Head = resolveComponent("Head");
  const _component_Footer = resolveComponent("Footer");
  _push(`<!--[--><header${ssrRenderAttr("dir", _ctx.dir())}>`);
  _push(ssrRenderComponent(_component_Navbar, null, null, _parent));
  _push(`</header><main${ssrRenderAttr("dir", _ctx.dir())} class="min-h-screen">`);
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
  ssrRenderSlot(_ctx.$slots, "default", {}, null, _push, _parent);
  _push(`</main>`);
  _push(ssrRenderComponent(_component_Footer, null, null, _parent));
  _push(`<!--]-->`);
}
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Layouts/Scaffold.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const Scaffold = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  Scaffold as S
};
