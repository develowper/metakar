import { computed, mergeProps, useSSRContext, ref, withCtx, unref, createVNode, isRef, openBlock, createBlock, createTextVNode, toDisplayString, createCommentVNode, withModifiers } from "vue";
import { ssrRenderAttrs, ssrLooseContain, ssrGetDynamicModelProps, ssrRenderComponent, ssrInterpolate } from "vue/server-renderer";
import { _ as _sfc_main$2 } from "./GuestLayout-7ef511d4.mjs";
import { _ as _sfc_main$3, a as _sfc_main$4, b as _sfc_main$5 } from "./TextInput-ecbf2d73.mjs";
import { _ as _sfc_main$6 } from "./PrimaryButton-bd98da7a.mjs";
import { useForm, Head, Link } from "@inertiajs/vue3";
import { UserIcon, EyeIcon, EyeSlashIcon } from "@heroicons/vue/24/outline";
import "./ApplicationLogo-7135a78a.mjs";
import "./_plugin-vue_export-helper-cc2b3d55.mjs";
const _sfc_main$1 = {
  __name: "Checkbox",
  __ssrInlineRender: true,
  props: {
    checked: {
      type: [Array, Boolean],
      default: false
    },
    value: {
      default: null
    }
  },
  emits: ["update:checked"],
  setup(__props, { emit }) {
    const props = __props;
    const proxyChecked = computed({
      get() {
        return props.checked;
      },
      set(val) {
        emit("update:checked", val);
      }
    });
    return (_ctx, _push, _parent, _attrs) => {
      let _temp0;
      _push(`<input${ssrRenderAttrs((_temp0 = mergeProps({
        type: "checkbox",
        value: __props.value,
        checked: Array.isArray(proxyChecked.value) ? ssrLooseContain(proxyChecked.value, __props.value) : proxyChecked.value,
        class: "rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
      }, _attrs), mergeProps(_temp0, ssrGetDynamicModelProps(_temp0, proxyChecked.value))))}>`);
    };
  }
};
const _sfc_setup$1 = _sfc_main$1.setup;
_sfc_main$1.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/Checkbox.vue");
  return _sfc_setup$1 ? _sfc_setup$1(props, ctx) : void 0;
};
const _sfc_main = {
  __name: "Login",
  __ssrInlineRender: true,
  props: {
    canResetPassword: Boolean,
    status: String
  },
  setup(__props) {
    let showPassword = ref(false);
    const form = useForm({
      login: "",
      password: "",
      remember: false
    });
    const submit = () => {
      form.post(route("login"), {
        onFinish: () => form.reset("password")
      });
    };
    return (_ctx, _push, _parent, _attrs) => {
      _push(ssrRenderComponent(_sfc_main$2, mergeProps({
        dir: _ctx.dir()
      }, _attrs), {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(ssrRenderComponent(unref(Head), {
              title: _ctx.__("signin")
            }, null, _parent2, _scopeId));
            if (__props.status) {
              _push2(`<div class="mb-4 font-medium text-sm text-green-600"${_scopeId}>${ssrInterpolate(__props.status)}</div>`);
            } else {
              _push2(`<!---->`);
            }
            _push2(`<form${_scopeId}><div${_scopeId}>`);
            _push2(ssrRenderComponent(_sfc_main$3, {
              for: "login",
              value: _ctx.__("email") + "/" + _ctx.__("phone")
            }, null, _parent2, _scopeId));
            _push2(ssrRenderComponent(_sfc_main$4, {
              id: "login",
              type: "text",
              classes: "  ",
              modelValue: unref(form).login,
              "onUpdate:modelValue": ($event) => unref(form).login = $event,
              required: "",
              autofocus: "",
              autocomplete: "login"
            }, {
              prepend: withCtx((_2, _push3, _parent3, _scopeId2) => {
                if (_push3) {
                  _push3(`<div class="p-3"${_scopeId2}>`);
                  _push3(ssrRenderComponent(unref(UserIcon), { class: "h-5 w-5" }, null, _parent3, _scopeId2));
                  _push3(`</div>`);
                } else {
                  return [
                    createVNode("div", { class: "p-3" }, [
                      createVNode(unref(UserIcon), { class: "h-5 w-5" })
                    ])
                  ];
                }
              }),
              _: 1
            }, _parent2, _scopeId));
            _push2(ssrRenderComponent(_sfc_main$5, {
              class: "mt-2",
              message: unref(form).errors.login
            }, null, _parent2, _scopeId));
            _push2(`</div><div class="mt-4"${_scopeId}>`);
            _push2(ssrRenderComponent(_sfc_main$3, {
              for: "password",
              value: _ctx.__("password")
            }, null, _parent2, _scopeId));
            _push2(ssrRenderComponent(_sfc_main$4, {
              id: "password",
              type: unref(showPassword) ? "text" : "password",
              classes: " ",
              modelValue: unref(form).password,
              "onUpdate:modelValue": ($event) => unref(form).password = $event,
              required: "",
              autocomplete: "current-password"
            }, {
              prepend: withCtx((_2, _push3, _parent3, _scopeId2) => {
                if (_push3) {
                  _push3(`<div class="p-3"${_scopeId2}>`);
                  if (!unref(showPassword)) {
                    _push3(ssrRenderComponent(unref(EyeIcon), { class: "h-5 w-5" }, null, _parent3, _scopeId2));
                  } else {
                    _push3(ssrRenderComponent(unref(EyeSlashIcon), { class: "h-5 w-5" }, null, _parent3, _scopeId2));
                  }
                  _push3(`</div>`);
                } else {
                  return [
                    createVNode("div", {
                      class: "p-3",
                      onClick: ($event) => isRef(showPassword) ? showPassword.value = !unref(showPassword) : showPassword = !unref(showPassword)
                    }, [
                      !unref(showPassword) ? (openBlock(), createBlock(unref(EyeIcon), {
                        key: 0,
                        class: "h-5 w-5"
                      })) : (openBlock(), createBlock(unref(EyeSlashIcon), {
                        key: 1,
                        class: "h-5 w-5"
                      }))
                    ], 8, ["onClick"])
                  ];
                }
              }),
              _: 1
            }, _parent2, _scopeId));
            _push2(ssrRenderComponent(_sfc_main$5, {
              class: "mt-2",
              message: unref(form).errors.password
            }, null, _parent2, _scopeId));
            _push2(`</div><div class="flex mt-4 items-center justify-between"${_scopeId}><label class="flex items-center"${_scopeId}>`);
            _push2(ssrRenderComponent(_sfc_main$1, {
              name: "remember",
              checked: unref(form).remember,
              "onUpdate:checked": ($event) => unref(form).remember = $event
            }, null, _parent2, _scopeId));
            _push2(`<span class="m-2 text-sm text-gray-600"${_scopeId}>${ssrInterpolate(_ctx.__("remember_me"))}</span></label>`);
            if (__props.canResetPassword) {
              _push2(ssrRenderComponent(unref(Link), {
                href: _ctx.route("password.request"),
                class: "underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
              }, {
                default: withCtx((_2, _push3, _parent3, _scopeId2) => {
                  if (_push3) {
                    _push3(`${ssrInterpolate(_ctx.__("forgot_my_password"))}`);
                  } else {
                    return [
                      createTextVNode(toDisplayString(_ctx.__("forgot_my_password")), 1)
                    ];
                  }
                }),
                _: 1
              }, _parent2, _scopeId));
            } else {
              _push2(`<!---->`);
            }
            _push2(`</div><div class="mt-4"${_scopeId}>`);
            _push2(ssrRenderComponent(_sfc_main$6, {
              class: ["w-full", { "opacity-25": unref(form).processing }],
              disabled: unref(form).processing
            }, {
              default: withCtx((_2, _push3, _parent3, _scopeId2) => {
                if (_push3) {
                  _push3(`<span class="text-lg w-full"${_scopeId2}>${ssrInterpolate(_ctx.__("signin"))}</span>`);
                } else {
                  return [
                    createVNode("span", { class: "text-lg w-full" }, toDisplayString(_ctx.__("signin")), 1)
                  ];
                }
              }),
              _: 1
            }, _parent2, _scopeId));
            _push2(`</div><div class="w-full mt-5"${_scopeId}><span${_scopeId}>${ssrInterpolate(_ctx.__("not_have_account?"))}</span>`);
            if (__props.canResetPassword) {
              _push2(ssrRenderComponent(unref(Link), {
                href: _ctx.route("register"),
                class: "underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
              }, {
                default: withCtx((_2, _push3, _parent3, _scopeId2) => {
                  if (_push3) {
                    _push3(`${ssrInterpolate(_ctx.__("signup"))}`);
                  } else {
                    return [
                      createTextVNode(toDisplayString(_ctx.__("signup")), 1)
                    ];
                  }
                }),
                _: 1
              }, _parent2, _scopeId));
            } else {
              _push2(`<!---->`);
            }
            _push2(`</div></form>`);
          } else {
            return [
              createVNode(unref(Head), {
                title: _ctx.__("signin")
              }, null, 8, ["title"]),
              __props.status ? (openBlock(), createBlock("div", {
                key: 0,
                class: "mb-4 font-medium text-sm text-green-600"
              }, toDisplayString(__props.status), 1)) : createCommentVNode("", true),
              createVNode("form", {
                onSubmit: withModifiers(submit, ["prevent"])
              }, [
                createVNode("div", null, [
                  createVNode(_sfc_main$3, {
                    for: "login",
                    value: _ctx.__("email") + "/" + _ctx.__("phone")
                  }, null, 8, ["value"]),
                  createVNode(_sfc_main$4, {
                    id: "login",
                    type: "text",
                    classes: "  ",
                    modelValue: unref(form).login,
                    "onUpdate:modelValue": ($event) => unref(form).login = $event,
                    required: "",
                    autofocus: "",
                    autocomplete: "login"
                  }, {
                    prepend: withCtx(() => [
                      createVNode("div", { class: "p-3" }, [
                        createVNode(unref(UserIcon), { class: "h-5 w-5" })
                      ])
                    ]),
                    _: 1
                  }, 8, ["modelValue", "onUpdate:modelValue"]),
                  createVNode(_sfc_main$5, {
                    class: "mt-2",
                    message: unref(form).errors.login
                  }, null, 8, ["message"])
                ]),
                createVNode("div", { class: "mt-4" }, [
                  createVNode(_sfc_main$3, {
                    for: "password",
                    value: _ctx.__("password")
                  }, null, 8, ["value"]),
                  createVNode(_sfc_main$4, {
                    id: "password",
                    type: unref(showPassword) ? "text" : "password",
                    classes: " ",
                    modelValue: unref(form).password,
                    "onUpdate:modelValue": ($event) => unref(form).password = $event,
                    required: "",
                    autocomplete: "current-password"
                  }, {
                    prepend: withCtx(() => [
                      createVNode("div", {
                        class: "p-3",
                        onClick: ($event) => isRef(showPassword) ? showPassword.value = !unref(showPassword) : showPassword = !unref(showPassword)
                      }, [
                        !unref(showPassword) ? (openBlock(), createBlock(unref(EyeIcon), {
                          key: 0,
                          class: "h-5 w-5"
                        })) : (openBlock(), createBlock(unref(EyeSlashIcon), {
                          key: 1,
                          class: "h-5 w-5"
                        }))
                      ], 8, ["onClick"])
                    ]),
                    _: 1
                  }, 8, ["type", "modelValue", "onUpdate:modelValue"]),
                  createVNode(_sfc_main$5, {
                    class: "mt-2",
                    message: unref(form).errors.password
                  }, null, 8, ["message"])
                ]),
                createVNode("div", { class: "flex mt-4 items-center justify-between" }, [
                  createVNode("label", { class: "flex items-center" }, [
                    createVNode(_sfc_main$1, {
                      name: "remember",
                      checked: unref(form).remember,
                      "onUpdate:checked": ($event) => unref(form).remember = $event
                    }, null, 8, ["checked", "onUpdate:checked"]),
                    createVNode("span", { class: "m-2 text-sm text-gray-600" }, toDisplayString(_ctx.__("remember_me")), 1)
                  ]),
                  __props.canResetPassword ? (openBlock(), createBlock(unref(Link), {
                    key: 0,
                    href: _ctx.route("password.request"),
                    class: "underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                  }, {
                    default: withCtx(() => [
                      createTextVNode(toDisplayString(_ctx.__("forgot_my_password")), 1)
                    ]),
                    _: 1
                  }, 8, ["href"])) : createCommentVNode("", true)
                ]),
                createVNode("div", { class: "mt-4" }, [
                  createVNode(_sfc_main$6, {
                    class: ["w-full", { "opacity-25": unref(form).processing }],
                    disabled: unref(form).processing
                  }, {
                    default: withCtx(() => [
                      createVNode("span", { class: "text-lg w-full" }, toDisplayString(_ctx.__("signin")), 1)
                    ]),
                    _: 1
                  }, 8, ["class", "disabled"])
                ]),
                createVNode("div", { class: "w-full mt-5" }, [
                  createVNode("span", null, toDisplayString(_ctx.__("not_have_account?")), 1),
                  __props.canResetPassword ? (openBlock(), createBlock(unref(Link), {
                    key: 0,
                    href: _ctx.route("register"),
                    class: "underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                  }, {
                    default: withCtx(() => [
                      createTextVNode(toDisplayString(_ctx.__("signup")), 1)
                    ]),
                    _: 1
                  }, 8, ["href"])) : createCommentVNode("", true)
                ])
              ], 40, ["onSubmit"])
            ];
          }
        }),
        _: 1
      }, _parent));
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Auth/Login.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
