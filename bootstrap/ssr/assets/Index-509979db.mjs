import "./Scaffold-3db47b1e.mjs";
import { P as Panel } from "./Panel-d5ccd907.mjs";
import { Head, Link } from "@inertiajs/vue3";
import { HomeIcon, ChevronDownIcon } from "@heroicons/vue/24/outline";
import { resolveComponent, withCtx, createVNode, toDisplayString, useSSRContext } from "vue";
import { ssrRenderComponent, ssrInterpolate } from "vue/server-renderer";
import { _ as _export_sfc } from "./_plugin-vue_export-helper-cc2b3d55.mjs";
import "./Image-0110566e.mjs";
import "./ApplicationLogo-7135a78a.mjs";
import "vue-plugin-load-script";
import "tw-elements";
const _sfc_main = {
  components: {
    Head,
    Link,
    HomeIcon,
    ChevronDownIcon,
    Panel
  },
  mounted() {
  }
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_Panel = resolveComponent("Panel");
  const _component_Link = resolveComponent("Link");
  _push(ssrRenderComponent(_component_Panel, _attrs, {
    header: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`<title${_scopeId}>${ssrInterpolate(_ctx.__("panel"))}</title>`);
      } else {
        return [
          createVNode("title", null, toDisplayString(_ctx.__("panel")), 1)
        ];
      }
    }),
    content: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`<div class="flex items-center justify-between px-4 py-4 text-primary-500 border-b lg:py-6 dark:border-primary-darker"${_scopeId}><h1 class="text-2xl font-semibold"${_scopeId}>${ssrInterpolate(_ctx.__("create_business"))}</h1>`);
        _push2(ssrRenderComponent(_component_Link, {
          href: "",
          target: "_blank",
          class: "px-4 py-2 text-sm text-white rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark"
        }, null, _parent2, _scopeId));
        _push2(`</div><div class="mt-2"${_scopeId}></div>`);
      } else {
        return [
          createVNode("div", { class: "flex items-center justify-between px-4 py-4 text-primary-500 border-b lg:py-6 dark:border-primary-darker" }, [
            createVNode("h1", { class: "text-2xl font-semibold" }, toDisplayString(_ctx.__("create_business")), 1),
            createVNode(_component_Link, {
              href: "",
              target: "_blank",
              class: "px-4 py-2 text-sm text-white rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark"
            })
          ]),
          createVNode("div", { class: "mt-2" })
        ];
      }
    }),
    _: 1
  }, _parent));
}
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Panel/Auction/Index.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const Index = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  Index as default
};
