import { S as Scaffold } from "./Scaffold-3db47b1e.mjs";
import { Head } from "@inertiajs/vue3";
import { h as heroImage } from "./hero-0be2797b.mjs";
import "vue-plugin-load-script";
import { _ as _sfc_main$2 } from "./PrimaryButton-bd98da7a.mjs";
import { _ as _sfc_main$1 } from "./SecondaryButton-ff78328e.mjs";
import { resolveComponent, withCtx, createVNode, toDisplayString, createTextVNode, openBlock, createBlock, useSSRContext } from "vue";
import { ssrRenderComponent, ssrInterpolate, ssrRenderAttr } from "vue/server-renderer";
import { _ as _export_sfc } from "./_plugin-vue_export-helper-cc2b3d55.mjs";
import "@heroicons/vue/24/outline";
import "./Image-0110566e.mjs";
import "./ApplicationLogo-7135a78a.mjs";
const Main_vue_vue_type_style_index_0_lang = "";
const _sfc_main = {
  data() {
    return {
      heroImage
    };
  },
  props: ["heroText"],
  components: { SecondaryButton: _sfc_main$1, PrimaryButton: _sfc_main$2, Scaffold, Head },
  // mixins: [Mixin],
  setup(props) {
  },
  mounted() {
  }
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_Scaffold = resolveComponent("Scaffold");
  const _component_PrimaryButton = resolveComponent("PrimaryButton");
  const _component_SecondaryButton = resolveComponent("SecondaryButton");
  _push(ssrRenderComponent(_component_Scaffold, _attrs, {
    header: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`<title${_scopeId}>${ssrInterpolate(_ctx.__("home"))}</title>`);
      } else {
        return [
          createVNode("title", null, toDisplayString(_ctx.__("home")), 1)
        ];
      }
    }),
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`<div class="relative bg-gradient-to-t from-pink-300 via-purple-300 to-indigo-400"${_scopeId}><div class="py-24 container mx-auto"${_scopeId}><div class="px-3 flex flex-col md:flex-row items-center"${_scopeId}><div class="md:w-2/5 py-6 text-center"${_scopeId}><img class="md:w-full w-1/3 mx-auto z-50"${ssrRenderAttr("src", $data.heroImage)}${_scopeId}></div><div class="flex flex-col max-w-lg text-white w-full md:w-3/5 justify-center text-center"${_scopeId}><h1 class="my-4 text-5xl font-bold leading-tight"${_scopeId}>${ssrInterpolate(_ctx.__("app_name"))}</h1><p class="leading-normal text-2xl mb-8"${_scopeId}>${ssrInterpolate($props.heroText)}</p><div class="w-full mx-auto mt-2 my-10"${_scopeId}><div class="relative px-6 mx-auto"${_scopeId}><div class="absolute top-0 bottom-0 start-0 flex items-center opacity-60 ps-10"${_scopeId}><svg class="w-4 h-4 text-gray-600 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"${_scopeId}><path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"${_scopeId}></path></svg><span class="absolute border-gray-300 border-s top-0 bottom-0 my-2 ms-6"${_scopeId}></span></div><input id="search-toggle" type="search"${ssrRenderAttr("placeholder", _ctx.__("hero_search_placeholder"))} class="placeholder-gray-400 border-transparent block w-full py-3 ps-12 pe-4 font-bold text-gray-700 bg-gray-100 rounded-lg shadow-lg focus:outline-none focus:bg-white" onkeyup="updateSearchResults(this.value);"${_scopeId}></div></div><div class="px-3 flex items-center"${_scopeId}>`);
        _push2(ssrRenderComponent(_component_PrimaryButton, { class: "mx-2 p-2 grow" }, {
          default: withCtx((_2, _push3, _parent3, _scopeId2) => {
            if (_push3) {
              _push3(`${ssrInterpolate(_ctx.__("adv_create"))}`);
            } else {
              return [
                createTextVNode(toDisplayString(_ctx.__("adv_create")), 1)
              ];
            }
          }),
          _: 1
        }, _parent2, _scopeId));
        _push2(ssrRenderComponent(_component_SecondaryButton, { class: "mx-2 p-2 grow" }, {
          default: withCtx((_2, _push3, _parent3, _scopeId2) => {
            if (_push3) {
              _push3(`${ssrInterpolate(_ctx.__("make_money"))}`);
            } else {
              return [
                createTextVNode(toDisplayString(_ctx.__("make_money")), 1)
              ];
            }
          }),
          _: 1
        }, _parent2, _scopeId));
        _push2(`</div></div></div></div><div class="absolute bottom-0 start-0 end-0"${_scopeId}><svg viewBox="0 0 1428 174" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"${_scopeId}><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"${_scopeId}><g transform="translate(-2.000000, 44.000000)" fill="#FFFFFF" fill-rule="nonzero"${_scopeId}><path d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496" opacity="0.100000001"${_scopeId}></path><path d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z" opacity="0.100000001"${_scopeId}></path><path d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z" id="Path-4" opacity="0.200000003"${_scopeId}></path></g><g transform="translate(-4.000000, 76.000000)" fill="#FFFFFF" fill-rule="nonzero"${_scopeId}><path d="M0.457,34.035 C57.086,53.198 98.208,65.809 123.822,71.865 C181.454,85.495 234.295,90.29 272.033,93.459 C311.355,96.759 396.635,95.801 461.025,91.663 C486.76,90.01 518.727,86.372 556.926,80.752 C595.747,74.596 622.372,70.008 636.799,66.991 C663.913,61.324 712.501,49.503 727.605,46.128 C780.47,34.317 818.839,22.532 856.324,15.904 C922.689,4.169 955.676,2.522 1011.185,0.432 C1060.705,1.477 1097.39,3.129 1121.236,5.387 C1161.703,9.219 1208.621,17.821 1235.4,22.304 C1285.855,30.748 1354.351,47.432 1440.886,72.354 L1441.191,104.352 L1.121,104.031 L0.457,34.035 Z"${_scopeId}></path></g></g></svg></div></div>`);
      } else {
        return [
          createVNode("div", { class: "relative bg-gradient-to-t from-pink-300 via-purple-300 to-indigo-400" }, [
            createVNode("div", { class: "py-24 container mx-auto" }, [
              createVNode("div", { class: "px-3 flex flex-col md:flex-row items-center" }, [
                createVNode("div", { class: "md:w-2/5 py-6 text-center" }, [
                  createVNode("img", {
                    class: "md:w-full w-1/3 mx-auto z-50",
                    src: $data.heroImage
                  }, null, 8, ["src"])
                ]),
                createVNode("div", { class: "flex flex-col max-w-lg text-white w-full md:w-3/5 justify-center text-center" }, [
                  createVNode("h1", { class: "my-4 text-5xl font-bold leading-tight" }, toDisplayString(_ctx.__("app_name")), 1),
                  createVNode("p", { class: "leading-normal text-2xl mb-8" }, toDisplayString($props.heroText), 1),
                  createVNode("div", { class: "w-full mx-auto mt-2 my-10" }, [
                    createVNode("div", { class: "relative px-6 mx-auto" }, [
                      createVNode("div", { class: "absolute top-0 bottom-0 start-0 flex items-center opacity-60 ps-10" }, [
                        (openBlock(), createBlock("svg", {
                          class: "w-4 h-4 text-gray-600 fill-current",
                          xmlns: "http://www.w3.org/2000/svg",
                          viewBox: "0 0 20 20"
                        }, [
                          createVNode("path", { d: "M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" })
                        ])),
                        createVNode("span", { class: "absolute border-gray-300 border-s top-0 bottom-0 my-2 ms-6" })
                      ]),
                      createVNode("input", {
                        id: "search-toggle",
                        type: "search",
                        placeholder: _ctx.__("hero_search_placeholder"),
                        class: "placeholder-gray-400 border-transparent block w-full py-3 ps-12 pe-4 font-bold text-gray-700 bg-gray-100 rounded-lg shadow-lg focus:outline-none focus:bg-white",
                        onkeyup: "updateSearchResults(this.value);"
                      }, null, 8, ["placeholder"])
                    ])
                  ]),
                  createVNode("div", { class: "px-3 flex items-center" }, [
                    createVNode(_component_PrimaryButton, { class: "mx-2 p-2 grow" }, {
                      default: withCtx(() => [
                        createTextVNode(toDisplayString(_ctx.__("adv_create")), 1)
                      ]),
                      _: 1
                    }),
                    createVNode(_component_SecondaryButton, { class: "mx-2 p-2 grow" }, {
                      default: withCtx(() => [
                        createTextVNode(toDisplayString(_ctx.__("make_money")), 1)
                      ]),
                      _: 1
                    })
                  ])
                ])
              ])
            ]),
            createVNode("div", { class: "absolute bottom-0 start-0 end-0" }, [
              (openBlock(), createBlock("svg", {
                viewBox: "0 0 1428 174",
                version: "1.1",
                xmlns: "http://www.w3.org/2000/svg",
                "xmlns:xlink": "http://www.w3.org/1999/xlink"
              }, [
                createVNode("g", {
                  stroke: "none",
                  "stroke-width": "1",
                  fill: "none",
                  "fill-rule": "evenodd"
                }, [
                  createVNode("g", {
                    transform: "translate(-2.000000, 44.000000)",
                    fill: "#FFFFFF",
                    "fill-rule": "nonzero"
                  }, [
                    createVNode("path", {
                      d: "M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496",
                      opacity: "0.100000001"
                    }),
                    createVNode("path", {
                      d: "M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z",
                      opacity: "0.100000001"
                    }),
                    createVNode("path", {
                      d: "M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z",
                      id: "Path-4",
                      opacity: "0.200000003"
                    })
                  ]),
                  createVNode("g", {
                    transform: "translate(-4.000000, 76.000000)",
                    fill: "#FFFFFF",
                    "fill-rule": "nonzero"
                  }, [
                    createVNode("path", { d: "M0.457,34.035 C57.086,53.198 98.208,65.809 123.822,71.865 C181.454,85.495 234.295,90.29 272.033,93.459 C311.355,96.759 396.635,95.801 461.025,91.663 C486.76,90.01 518.727,86.372 556.926,80.752 C595.747,74.596 622.372,70.008 636.799,66.991 C663.913,61.324 712.501,49.503 727.605,46.128 C780.47,34.317 818.839,22.532 856.324,15.904 C922.689,4.169 955.676,2.522 1011.185,0.432 C1060.705,1.477 1097.39,3.129 1121.236,5.387 C1161.703,9.219 1208.621,17.821 1235.4,22.304 C1285.855,30.748 1354.351,47.432 1440.886,72.354 L1441.191,104.352 L1.121,104.031 L0.457,34.035 Z" })
                  ])
                ])
              ]))
            ])
          ])
        ];
      }
    }),
    _: 1
  }, _parent));
}
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Main.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const Main = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  Main as default
};
