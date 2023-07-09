import { S as Scaffold } from "./Scaffold-3db47b1e.mjs";
import { P as Panel } from "./Panel-d5ccd907.mjs";
import { Head, Link } from "@inertiajs/vue3";
import "vue-plugin-load-script";
import { CurrencyDollarIcon, TicketIcon } from "@heroicons/vue/24/outline";
import { resolveComponent, withCtx, createVNode, toDisplayString, openBlock, createBlock, Fragment, renderList, useSSRContext } from "vue";
import { ssrRenderComponent, ssrInterpolate, ssrRenderList, ssrRenderClass, ssrRenderStyle } from "vue/server-renderer";
import { _ as _export_sfc } from "./_plugin-vue_export-helper-cc2b3d55.mjs";
import "./Image-0110566e.mjs";
import "./ApplicationLogo-7135a78a.mjs";
import "tw-elements";
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
      user: this.$page.props.auth.user,
      tickets: this.$page.props.tickets
    };
  },
  components: { Panel, Scaffold, CurrencyDollarIcon, TicketIcon, Head, Link },
  mounted() {
  }
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_Panel = resolveComponent("Panel");
  const _component_CurrencyDollarIcon = resolveComponent("CurrencyDollarIcon");
  const _component_Link = resolveComponent("Link");
  const _component_TicketIcon = resolveComponent("TicketIcon");
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
        _push2(`<div class="flex items-center justify-between px-4 py-2 border-b lg:py-4 dark:border-primary-darker"${_scopeId}><h1 class="text-2xl font-semibold"${_scopeId}>${ssrInterpolate(_ctx.__("statistics"))}</h1></div><div class="mt-2"${_scopeId}><div class="grid grid-cols-1 gap-8 p-4 lg:grid-cols-2 xl:grid-cols-3"${_scopeId}><div class="flex shadow-sm items-center justify-between p-4 bg-white rounded-lg dark:bg-darker"${_scopeId}><div${_scopeId}><h6 class="text-xs font-bold py-2 tracking-wider text-gray-500 uppercase dark:text-primary-light"${_scopeId}>${ssrInterpolate(_ctx.__("wallet"))}</h6><span class="text-xl font-semibold"${_scopeId}>${ssrInterpolate(_ctx.asPrice($data.user.wallet))} ${ssrInterpolate(_ctx.__("currency"))}</span></div><div${_scopeId}>`);
        _push2(ssrRenderComponent(_component_CurrencyDollarIcon, { class: "w-12 h-12 text-primary-300 dark:text-pink-50" }, null, _parent2, _scopeId));
        _push2(`</div></div>`);
        _push2(ssrRenderComponent(_component_Link, {
          href: _ctx.route("panel.ticket.index"),
          class: "flex hover:scale-[101%] transition duration-300 cursor-pointer shadow-sm items-center justify-around p-4 bg-white rounded-lg dark:bg-darker"
        }, {
          default: withCtx((_2, _push3, _parent3, _scopeId2) => {
            if (_push3) {
              _push3(`<div class="flex flex-col grow"${_scopeId2}><h6 class="text-xs font-bold py-2 tracking-wider text-gray-500 uppercase dark:text-primary-light"${_scopeId2}>${ssrInterpolate(_ctx.__("tickets"))}</h6><div class="justify-center flex"${_scopeId2}><!--[-->`);
              ssrRenderList($data.tickets, (t, idx) => {
                _push3(`<span class="align-middle flex flex-col text-center"${_scopeId2}><span class="${ssrRenderClass([idx == 0 ? "text-red-500" : idx == 1 ? "text-primary-500" : "text-green-500", "text-xl font-semibold"])}"${_scopeId2}>${ssrInterpolate(t.value)}</span><span class="${ssrRenderClass([idx == 0 ? "bg-red-100 text-red-500" : idx == 1 ? "bg-primary-100 text-primary-500" : "bg-green-100 text-green-500", "mx-1 px-2 py-1 text-xs rounded-md"])}"${_scopeId2}>${ssrInterpolate(t.title)}</span></span>`);
              });
              _push3(`<!--]--></div></div><div class="flex"${_scopeId2}>`);
              _push3(ssrRenderComponent(_component_TicketIcon, { class: "w-12 h-12 text-primary-300 dark:text-pink-50" }, null, _parent3, _scopeId2));
              _push3(`</div>`);
            } else {
              return [
                createVNode("div", { class: "flex flex-col grow" }, [
                  createVNode("h6", { class: "text-xs font-bold py-2 tracking-wider text-gray-500 uppercase dark:text-primary-light" }, toDisplayString(_ctx.__("tickets")), 1),
                  createVNode("div", { class: "justify-center flex" }, [
                    (openBlock(true), createBlock(Fragment, null, renderList($data.tickets, (t, idx) => {
                      return openBlock(), createBlock("span", { class: "align-middle flex flex-col text-center" }, [
                        createVNode("span", {
                          class: [idx == 0 ? "text-red-500" : idx == 1 ? "text-primary-500" : "text-green-500", "text-xl font-semibold"]
                        }, toDisplayString(t.value), 3),
                        createVNode("span", {
                          class: [idx == 0 ? "bg-red-100 text-red-500" : idx == 1 ? "bg-primary-100 text-primary-500" : "bg-green-100 text-green-500", "mx-1 px-2 py-1 text-xs rounded-md"]
                        }, toDisplayString(t.title), 3)
                      ]);
                    }), 256))
                  ])
                ]),
                createVNode("div", { class: "flex" }, [
                  createVNode(_component_TicketIcon, { class: "w-12 h-12 text-primary-300 dark:text-pink-50" })
                ])
              ];
            }
          }),
          _: 1
        }, _parent2, _scopeId));
        _push2(`</div><div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3"${_scopeId}><div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }"${_scopeId}><div class="flex items-center justify-between p-4 border-b dark:border-primary"${_scopeId}><h4 class="text-lg font-semibold text-gray-500 dark:text-light"${_scopeId}>Bar Chart</h4><div class="flex items-center space-x-2"${_scopeId}><span class="text-sm text-gray-500 dark:text-light"${_scopeId}>Last year</span><button class="relative focus:outline-none"${_scopeId}><div class="w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-darker"${_scopeId}></div><div class="${ssrRenderClass([{ "translate-x-0  bg-white dark:bg-primary-100": !$data.isOn, "translate-x-6 bg-primary-light dark:bg-primary": $data.isOn }, "absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-200 ease-in-out transform scale-110 rounded-full shadow-sm translate-x-0 bg-white dark:bg-primary-100"])}"${_scopeId}></div></button></div></div><div class="relative p-4 h-72"${_scopeId}><div class="chartjs-size-monitor"${_scopeId}><div class="chartjs-size-monitor-expand"${_scopeId}><div class=""${_scopeId}></div></div><div class="chartjs-size-monitor-shrink"${_scopeId}><div class=""${_scopeId}></div></div></div><canvas id="barChart" style="${ssrRenderStyle({ "display": "block", "width": "505px", "height": "256px" })}" width="505" height="256" class="chartjs-render-monitor"${_scopeId}></canvas></div></div><div class="bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }"${_scopeId}><div class="flex items-center justify-between p-4 border-b dark:border-primary"${_scopeId}><h4 class="text-lg font-semibold text-gray-500 dark:text-light"${_scopeId}>Doughnut Chart</h4><div class="flex items-center"${_scopeId}><button class="relative focus:outline-none"${_scopeId}><div class="w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-darker"${_scopeId}></div><div class="${ssrRenderClass([{ "translate-x-0  bg-white dark:bg-primary-100": !$data.isOn, "translate-x-6 bg-primary-light dark:bg-primary": $data.isOn }, "absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-200 ease-in-out transform scale-110 rounded-full shadow-sm translate-x-0 bg-white dark:bg-primary-100"])}"${_scopeId}></div></button></div></div><div class="relative p-4 h-72"${_scopeId}><div class="chartjs-size-monitor"${_scopeId}><div class="chartjs-size-monitor-expand"${_scopeId}><div class=""${_scopeId}></div></div><div class="chartjs-size-monitor-shrink"${_scopeId}><div class=""${_scopeId}></div></div></div><canvas id="doughnutChart" width="505" height="256" style="${ssrRenderStyle({ "display": "block", "width": "505px", "height": "256px" })}" class="chartjs-render-monitor"${_scopeId}></canvas></div></div></div><div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3"${_scopeId}><div class="col-span-1 bg-white rounded-md dark:bg-darker"${_scopeId}><div class="p-4 border-b dark:border-primary"${_scopeId}><h4 class="text-lg font-semibold text-gray-500 dark:text-light"${_scopeId}>Active users right now</h4></div><p class="p-4"${_scopeId}><span class="text-2xl font-medium text-gray-500 dark:text-light" id="usersCount"${_scopeId}>104</span><span class="text-sm font-medium text-gray-500 dark:text-primary"${_scopeId}>Users</span></p><div class="relative p-4"${_scopeId}><div class="chartjs-size-monitor"${_scopeId}><div class="chartjs-size-monitor-expand"${_scopeId}><div class=""${_scopeId}></div></div><div class="chartjs-size-monitor-shrink"${_scopeId}><div class=""${_scopeId}></div></div></div><canvas id="activeUsersChart" width="505" height="150" style="${ssrRenderStyle({ "display": "block", "width": "505px", "height": "150px" })}" class="chartjs-render-monitor"${_scopeId}></canvas></div></div><div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }"${_scopeId}><div class="flex items-center justify-between p-4 border-b dark:border-primary"${_scopeId}><h4 class="text-lg font-semibold text-gray-500 dark:text-light"${_scopeId}>Line Chart</h4><div class="flex items-center"${_scopeId}><button class="relative focus:outline-none"${_scopeId}><div class="w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-darker"${_scopeId}></div><div class="${ssrRenderClass([{ "translate-x-0  bg-white dark:bg-primary-100": !$data.isOn, "translate-x-6 bg-primary-light dark:bg-primary": $data.isOn }, "absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-200 ease-in-out transform scale-110 rounded-full shadow-sm translate-x-0 bg-white dark:bg-primary-100"])}"${_scopeId}></div></button></div></div><div class="relative p-4 h-72"${_scopeId}><div class="chartjs-size-monitor"${_scopeId}><div class="chartjs-size-monitor-expand"${_scopeId}><div class=""${_scopeId}></div></div><div class="chartjs-size-monitor-shrink"${_scopeId}><div class=""${_scopeId}></div></div></div><canvas id="lineChart" width="505" height="256" style="${ssrRenderStyle({ "display": "block", "width": "505px", "height": "256px" })}" class="chartjs-render-monitor"${_scopeId}></canvas></div></div></div></div>`);
      } else {
        return [
          createVNode("div", { class: "flex items-center justify-between px-4 py-2 border-b lg:py-4 dark:border-primary-darker" }, [
            createVNode("h1", { class: "text-2xl font-semibold" }, toDisplayString(_ctx.__("statistics")), 1)
          ]),
          createVNode("div", { class: "mt-2" }, [
            createVNode("div", { class: "grid grid-cols-1 gap-8 p-4 lg:grid-cols-2 xl:grid-cols-3" }, [
              createVNode("div", { class: "flex shadow-sm items-center justify-between p-4 bg-white rounded-lg dark:bg-darker" }, [
                createVNode("div", null, [
                  createVNode("h6", { class: "text-xs font-bold py-2 tracking-wider text-gray-500 uppercase dark:text-primary-light" }, toDisplayString(_ctx.__("wallet")), 1),
                  createVNode("span", { class: "text-xl font-semibold" }, toDisplayString(_ctx.asPrice($data.user.wallet)) + " " + toDisplayString(_ctx.__("currency")), 1)
                ]),
                createVNode("div", null, [
                  createVNode(_component_CurrencyDollarIcon, { class: "w-12 h-12 text-primary-300 dark:text-pink-50" })
                ])
              ]),
              createVNode(_component_Link, {
                href: _ctx.route("panel.ticket.index"),
                class: "flex hover:scale-[101%] transition duration-300 cursor-pointer shadow-sm items-center justify-around p-4 bg-white rounded-lg dark:bg-darker"
              }, {
                default: withCtx(() => [
                  createVNode("div", { class: "flex flex-col grow" }, [
                    createVNode("h6", { class: "text-xs font-bold py-2 tracking-wider text-gray-500 uppercase dark:text-primary-light" }, toDisplayString(_ctx.__("tickets")), 1),
                    createVNode("div", { class: "justify-center flex" }, [
                      (openBlock(true), createBlock(Fragment, null, renderList($data.tickets, (t, idx) => {
                        return openBlock(), createBlock("span", { class: "align-middle flex flex-col text-center" }, [
                          createVNode("span", {
                            class: [idx == 0 ? "text-red-500" : idx == 1 ? "text-primary-500" : "text-green-500", "text-xl font-semibold"]
                          }, toDisplayString(t.value), 3),
                          createVNode("span", {
                            class: [idx == 0 ? "bg-red-100 text-red-500" : idx == 1 ? "bg-primary-100 text-primary-500" : "bg-green-100 text-green-500", "mx-1 px-2 py-1 text-xs rounded-md"]
                          }, toDisplayString(t.title), 3)
                        ]);
                      }), 256))
                    ])
                  ]),
                  createVNode("div", { class: "flex" }, [
                    createVNode(_component_TicketIcon, { class: "w-12 h-12 text-primary-300 dark:text-pink-50" })
                  ])
                ]),
                _: 1
              }, 8, ["href"])
            ]),
            createVNode("div", { class: "grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3" }, [
              createVNode("div", {
                class: "col-span-2 bg-white rounded-md dark:bg-darker",
                "x-data": "{ isOn: false }"
              }, [
                createVNode("div", { class: "flex items-center justify-between p-4 border-b dark:border-primary" }, [
                  createVNode("h4", { class: "text-lg font-semibold text-gray-500 dark:text-light" }, "Bar Chart"),
                  createVNode("div", { class: "flex items-center space-x-2" }, [
                    createVNode("span", { class: "text-sm text-gray-500 dark:text-light" }, "Last year"),
                    createVNode("button", {
                      class: "relative focus:outline-none",
                      onClick: ($event) => {
                        $data.isOn = !$data.isOn;
                      }
                    }, [
                      createVNode("div", { class: "w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-darker" }),
                      createVNode("div", {
                        class: ["absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-200 ease-in-out transform scale-110 rounded-full shadow-sm translate-x-0 bg-white dark:bg-primary-100", { "translate-x-0  bg-white dark:bg-primary-100": !$data.isOn, "translate-x-6 bg-primary-light dark:bg-primary": $data.isOn }]
                      }, null, 2)
                    ], 8, ["onClick"])
                  ])
                ]),
                createVNode("div", { class: "relative p-4 h-72" }, [
                  createVNode("div", { class: "chartjs-size-monitor" }, [
                    createVNode("div", { class: "chartjs-size-monitor-expand" }, [
                      createVNode("div", { class: "" })
                    ]),
                    createVNode("div", { class: "chartjs-size-monitor-shrink" }, [
                      createVNode("div", { class: "" })
                    ])
                  ]),
                  createVNode("canvas", {
                    id: "barChart",
                    style: { "display": "block", "width": "505px", "height": "256px" },
                    width: "505",
                    height: "256",
                    class: "chartjs-render-monitor"
                  })
                ])
              ]),
              createVNode("div", {
                class: "bg-white rounded-md dark:bg-darker",
                "x-data": "{ isOn: false }"
              }, [
                createVNode("div", { class: "flex items-center justify-between p-4 border-b dark:border-primary" }, [
                  createVNode("h4", { class: "text-lg font-semibold text-gray-500 dark:text-light" }, "Doughnut Chart"),
                  createVNode("div", { class: "flex items-center" }, [
                    createVNode("button", {
                      class: "relative focus:outline-none",
                      onClick: ($event) => {
                        $data.isOn = !$data.isOn;
                        _ctx.$parent.updateDoughnutChart($data.isOn);
                      }
                    }, [
                      createVNode("div", { class: "w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-darker" }),
                      createVNode("div", {
                        class: ["absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-200 ease-in-out transform scale-110 rounded-full shadow-sm translate-x-0 bg-white dark:bg-primary-100", { "translate-x-0  bg-white dark:bg-primary-100": !$data.isOn, "translate-x-6 bg-primary-light dark:bg-primary": $data.isOn }]
                      }, null, 2)
                    ], 8, ["onClick"])
                  ])
                ]),
                createVNode("div", { class: "relative p-4 h-72" }, [
                  createVNode("div", { class: "chartjs-size-monitor" }, [
                    createVNode("div", { class: "chartjs-size-monitor-expand" }, [
                      createVNode("div", { class: "" })
                    ]),
                    createVNode("div", { class: "chartjs-size-monitor-shrink" }, [
                      createVNode("div", { class: "" })
                    ])
                  ]),
                  createVNode("canvas", {
                    id: "doughnutChart",
                    width: "505",
                    height: "256",
                    style: { "display": "block", "width": "505px", "height": "256px" },
                    class: "chartjs-render-monitor"
                  })
                ])
              ])
            ]),
            createVNode("div", { class: "grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3" }, [
              createVNode("div", { class: "col-span-1 bg-white rounded-md dark:bg-darker" }, [
                createVNode("div", { class: "p-4 border-b dark:border-primary" }, [
                  createVNode("h4", { class: "text-lg font-semibold text-gray-500 dark:text-light" }, "Active users right now")
                ]),
                createVNode("p", { class: "p-4" }, [
                  createVNode("span", {
                    class: "text-2xl font-medium text-gray-500 dark:text-light",
                    id: "usersCount"
                  }, "104"),
                  createVNode("span", { class: "text-sm font-medium text-gray-500 dark:text-primary" }, "Users")
                ]),
                createVNode("div", { class: "relative p-4" }, [
                  createVNode("div", { class: "chartjs-size-monitor" }, [
                    createVNode("div", { class: "chartjs-size-monitor-expand" }, [
                      createVNode("div", { class: "" })
                    ]),
                    createVNode("div", { class: "chartjs-size-monitor-shrink" }, [
                      createVNode("div", { class: "" })
                    ])
                  ]),
                  createVNode("canvas", {
                    id: "activeUsersChart",
                    width: "505",
                    height: "150",
                    style: { "display": "block", "width": "505px", "height": "150px" },
                    class: "chartjs-render-monitor"
                  })
                ])
              ]),
              createVNode("div", {
                class: "col-span-2 bg-white rounded-md dark:bg-darker",
                "x-data": "{ isOn: false }"
              }, [
                createVNode("div", { class: "flex items-center justify-between p-4 border-b dark:border-primary" }, [
                  createVNode("h4", { class: "text-lg font-semibold text-gray-500 dark:text-light" }, "Line Chart"),
                  createVNode("div", { class: "flex items-center" }, [
                    createVNode("button", {
                      class: "relative focus:outline-none",
                      onClick: ($event) => {
                        $data.isOn = !$data.isOn;
                        _ctx.$parent.updateLineChart();
                      }
                    }, [
                      createVNode("div", { class: "w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-darker" }),
                      createVNode("div", {
                        class: ["absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-200 ease-in-out transform scale-110 rounded-full shadow-sm translate-x-0 bg-white dark:bg-primary-100", { "translate-x-0  bg-white dark:bg-primary-100": !$data.isOn, "translate-x-6 bg-primary-light dark:bg-primary": $data.isOn }]
                      }, null, 2)
                    ], 8, ["onClick"])
                  ])
                ]),
                createVNode("div", { class: "relative p-4 h-72" }, [
                  createVNode("div", { class: "chartjs-size-monitor" }, [
                    createVNode("div", { class: "chartjs-size-monitor-expand" }, [
                      createVNode("div", { class: "" })
                    ]),
                    createVNode("div", { class: "chartjs-size-monitor-shrink" }, [
                      createVNode("div", { class: "" })
                    ])
                  ]),
                  createVNode("canvas", {
                    id: "lineChart",
                    width: "505",
                    height: "256",
                    style: { "display": "block", "width": "505px", "height": "256px" },
                    class: "chartjs-render-monitor"
                  })
                ])
              ])
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
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Business/Index.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const Index = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  Index as default
};
