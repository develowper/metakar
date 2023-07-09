import { S as Scaffold } from "./Scaffold-3db47b1e.mjs";
import { P as Panel } from "./Panel-d5ccd907.mjs";
import { resolveComponent, withCtx, createVNode, toDisplayString, openBlock, createBlock, useSSRContext } from "vue";
import { ssrRenderComponent, ssrInterpolate, ssrRenderClass, ssrRenderStyle } from "vue/server-renderer";
import { _ as _export_sfc } from "./_plugin-vue_export-helper-cc2b3d55.mjs";
import "@inertiajs/vue3";
import "@heroicons/vue/24/outline";
import "./Image-0110566e.mjs";
import "./ApplicationLogo-7135a78a.mjs";
import "vue-plugin-load-script";
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
      isOn: false
    };
  },
  components: { Panel, Scaffold },
  mounted() {
  }
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_Panel = resolveComponent("Panel");
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
        _push2(`<div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker"${_scopeId}><h1 class="text-2xl font-semibold"${_scopeId}>${ssrInterpolate(_ctx.__("statistics"))}</h1><a href="https://github.com/Kamona-WD/kwd-dashboard" target="_blank" class="px-4 py-2 text-sm text-white rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark"${_scopeId}> View on github </a></div><div class="mt-2"${_scopeId}><div class="grid grid-cols-1 gap-8 p-4 lg:grid-cols-2 xl:grid-cols-4"${_scopeId}><div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker"${_scopeId}><div${_scopeId}><h6 class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light"${_scopeId}> Value </h6><span class="text-xl font-semibold"${_scopeId}>$30,000</span><span class="inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md"${_scopeId}> +4.4% </span></div><div${_scopeId}><span${_scopeId}><svg class="w-12 h-12 text-gray-300 dark:text-primary-dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"${_scopeId}><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"${_scopeId}></path></svg></span></div></div><div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker"${_scopeId}><div${_scopeId}><h6 class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light"${_scopeId}> Users </h6><span class="text-xl font-semibold"${_scopeId}>50,021</span><span class="inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md"${_scopeId}> +2.6% </span></div><div${_scopeId}><span${_scopeId}><svg class="w-12 h-12 text-gray-300 dark:text-primary-dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"${_scopeId}><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"${_scopeId}></path></svg></span></div></div><div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker"${_scopeId}><div${_scopeId}><h6 class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light"${_scopeId}> Orders </h6><span class="text-xl font-semibold"${_scopeId}>45,021</span><span class="inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md"${_scopeId}> +3.1% </span></div><div${_scopeId}><span${_scopeId}><svg class="w-12 h-12 text-gray-300 dark:text-primary-dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"${_scopeId}><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"${_scopeId}></path></svg></span></div></div><div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker"${_scopeId}><div${_scopeId}><h6 class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light"${_scopeId}> Tickets </h6><span class="text-xl font-semibold"${_scopeId}>20,516</span><span class="inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md"${_scopeId}> +3.1% </span></div><div${_scopeId}><span${_scopeId}><svg class="w-12 h-12 text-gray-300 dark:text-primary-dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"${_scopeId}><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"${_scopeId}></path></svg></span></div></div></div><div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3"${_scopeId}><div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }"${_scopeId}><div class="flex items-center justify-between p-4 border-b dark:border-primary"${_scopeId}><h4 class="text-lg font-semibold text-gray-500 dark:text-light"${_scopeId}>Bar Chart</h4><div class="flex items-center space-x-2"${_scopeId}><span class="text-sm text-gray-500 dark:text-light"${_scopeId}>Last year</span><button class="relative focus:outline-none"${_scopeId}><div class="w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-darker"${_scopeId}></div><div class="${ssrRenderClass([{ "translate-x-0  bg-white dark:bg-primary-100": !$data.isOn, "translate-x-6 bg-primary-light dark:bg-primary": $data.isOn }, "absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-200 ease-in-out transform scale-110 rounded-full shadow-sm translate-x-0 bg-white dark:bg-primary-100"])}"${_scopeId}></div></button></div></div><div class="relative p-4 h-72"${_scopeId}><div class="chartjs-size-monitor"${_scopeId}><div class="chartjs-size-monitor-expand"${_scopeId}><div class=""${_scopeId}></div></div><div class="chartjs-size-monitor-shrink"${_scopeId}><div class=""${_scopeId}></div></div></div><canvas id="barChart" style="${ssrRenderStyle({ "display": "block", "width": "505px", "height": "256px" })}" width="505" height="256" class="chartjs-render-monitor"${_scopeId}></canvas></div></div><div class="bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }"${_scopeId}><div class="flex items-center justify-between p-4 border-b dark:border-primary"${_scopeId}><h4 class="text-lg font-semibold text-gray-500 dark:text-light"${_scopeId}>Doughnut Chart</h4><div class="flex items-center"${_scopeId}><button class="relative focus:outline-none"${_scopeId}><div class="w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-darker"${_scopeId}></div><div class="${ssrRenderClass([{ "translate-x-0  bg-white dark:bg-primary-100": !$data.isOn, "translate-x-6 bg-primary-light dark:bg-primary": $data.isOn }, "absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-200 ease-in-out transform scale-110 rounded-full shadow-sm translate-x-0 bg-white dark:bg-primary-100"])}"${_scopeId}></div></button></div></div><div class="relative p-4 h-72"${_scopeId}><div class="chartjs-size-monitor"${_scopeId}><div class="chartjs-size-monitor-expand"${_scopeId}><div class=""${_scopeId}></div></div><div class="chartjs-size-monitor-shrink"${_scopeId}><div class=""${_scopeId}></div></div></div><canvas id="doughnutChart" width="505" height="256" style="${ssrRenderStyle({ "display": "block", "width": "505px", "height": "256px" })}" class="chartjs-render-monitor"${_scopeId}></canvas></div></div></div><div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3"${_scopeId}><div class="col-span-1 bg-white rounded-md dark:bg-darker"${_scopeId}><div class="p-4 border-b dark:border-primary"${_scopeId}><h4 class="text-lg font-semibold text-gray-500 dark:text-light"${_scopeId}>Active users right now</h4></div><p class="p-4"${_scopeId}><span class="text-2xl font-medium text-gray-500 dark:text-light" id="usersCount"${_scopeId}>104</span><span class="text-sm font-medium text-gray-500 dark:text-primary"${_scopeId}>Users</span></p><div class="relative p-4"${_scopeId}><div class="chartjs-size-monitor"${_scopeId}><div class="chartjs-size-monitor-expand"${_scopeId}><div class=""${_scopeId}></div></div><div class="chartjs-size-monitor-shrink"${_scopeId}><div class=""${_scopeId}></div></div></div><canvas id="activeUsersChart" width="505" height="150" style="${ssrRenderStyle({ "display": "block", "width": "505px", "height": "150px" })}" class="chartjs-render-monitor"${_scopeId}></canvas></div></div><div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }"${_scopeId}><div class="flex items-center justify-between p-4 border-b dark:border-primary"${_scopeId}><h4 class="text-lg font-semibold text-gray-500 dark:text-light"${_scopeId}>Line Chart</h4><div class="flex items-center"${_scopeId}><button class="relative focus:outline-none"${_scopeId}><div class="w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-darker"${_scopeId}></div><div class="${ssrRenderClass([{ "translate-x-0  bg-white dark:bg-primary-100": !$data.isOn, "translate-x-6 bg-primary-light dark:bg-primary": $data.isOn }, "absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-200 ease-in-out transform scale-110 rounded-full shadow-sm translate-x-0 bg-white dark:bg-primary-100"])}"${_scopeId}></div></button></div></div><div class="relative p-4 h-72"${_scopeId}><div class="chartjs-size-monitor"${_scopeId}><div class="chartjs-size-monitor-expand"${_scopeId}><div class=""${_scopeId}></div></div><div class="chartjs-size-monitor-shrink"${_scopeId}><div class=""${_scopeId}></div></div></div><canvas id="lineChart" width="505" height="256" style="${ssrRenderStyle({ "display": "block", "width": "505px", "height": "256px" })}" class="chartjs-render-monitor"${_scopeId}></canvas></div></div></div></div>`);
      } else {
        return [
          createVNode("div", { class: "flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker" }, [
            createVNode("h1", { class: "text-2xl font-semibold" }, toDisplayString(_ctx.__("statistics")), 1),
            createVNode("a", {
              href: "https://github.com/Kamona-WD/kwd-dashboard",
              target: "_blank",
              class: "px-4 py-2 text-sm text-white rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark"
            }, " View on github ")
          ]),
          createVNode("div", { class: "mt-2" }, [
            createVNode("div", { class: "grid grid-cols-1 gap-8 p-4 lg:grid-cols-2 xl:grid-cols-4" }, [
              createVNode("div", { class: "flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker" }, [
                createVNode("div", null, [
                  createVNode("h6", { class: "text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light" }, " Value "),
                  createVNode("span", { class: "text-xl font-semibold" }, "$30,000"),
                  createVNode("span", { class: "inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md" }, " +4.4% ")
                ]),
                createVNode("div", null, [
                  createVNode("span", null, [
                    (openBlock(), createBlock("svg", {
                      class: "w-12 h-12 text-gray-300 dark:text-primary-dark",
                      xmlns: "http://www.w3.org/2000/svg",
                      fill: "none",
                      viewBox: "0 0 24 24",
                      stroke: "currentColor"
                    }, [
                      createVNode("path", {
                        "stroke-linecap": "round",
                        "stroke-linejoin": "round",
                        "stroke-width": "2",
                        d: "M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                      })
                    ]))
                  ])
                ])
              ]),
              createVNode("div", { class: "flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker" }, [
                createVNode("div", null, [
                  createVNode("h6", { class: "text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light" }, " Users "),
                  createVNode("span", { class: "text-xl font-semibold" }, "50,021"),
                  createVNode("span", { class: "inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md" }, " +2.6% ")
                ]),
                createVNode("div", null, [
                  createVNode("span", null, [
                    (openBlock(), createBlock("svg", {
                      class: "w-12 h-12 text-gray-300 dark:text-primary-dark",
                      xmlns: "http://www.w3.org/2000/svg",
                      fill: "none",
                      viewBox: "0 0 24 24",
                      stroke: "currentColor"
                    }, [
                      createVNode("path", {
                        "stroke-linecap": "round",
                        "stroke-linejoin": "round",
                        "stroke-width": "2",
                        d: "M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                      })
                    ]))
                  ])
                ])
              ]),
              createVNode("div", { class: "flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker" }, [
                createVNode("div", null, [
                  createVNode("h6", { class: "text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light" }, " Orders "),
                  createVNode("span", { class: "text-xl font-semibold" }, "45,021"),
                  createVNode("span", { class: "inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md" }, " +3.1% ")
                ]),
                createVNode("div", null, [
                  createVNode("span", null, [
                    (openBlock(), createBlock("svg", {
                      class: "w-12 h-12 text-gray-300 dark:text-primary-dark",
                      xmlns: "http://www.w3.org/2000/svg",
                      fill: "none",
                      viewBox: "0 0 24 24",
                      stroke: "currentColor"
                    }, [
                      createVNode("path", {
                        "stroke-linecap": "round",
                        "stroke-linejoin": "round",
                        "stroke-width": "2",
                        d: "M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"
                      })
                    ]))
                  ])
                ])
              ]),
              createVNode("div", { class: "flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker" }, [
                createVNode("div", null, [
                  createVNode("h6", { class: "text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light" }, " Tickets "),
                  createVNode("span", { class: "text-xl font-semibold" }, "20,516"),
                  createVNode("span", { class: "inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md" }, " +3.1% ")
                ]),
                createVNode("div", null, [
                  createVNode("span", null, [
                    (openBlock(), createBlock("svg", {
                      class: "w-12 h-12 text-gray-300 dark:text-primary-dark",
                      xmlns: "http://www.w3.org/2000/svg",
                      fill: "none",
                      viewBox: "0 0 24 24",
                      stroke: "currentColor"
                    }, [
                      createVNode("path", {
                        "stroke-linecap": "round",
                        "stroke-linejoin": "round",
                        "stroke-width": "2",
                        d: "M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"
                      })
                    ]))
                  ])
                ])
              ])
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
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Panel/Admin/Index.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const Index = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  Index as default
};
