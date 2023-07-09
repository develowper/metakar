import { UserIcon } from "@heroicons/vue/24/outline";
import { mergeProps, useSSRContext } from "vue";
import { ssrRenderAttrs } from "vue/server-renderer";
import { _ as _export_sfc } from "./_plugin-vue_export-helper-cc2b3d55.mjs";
let self;
const _sfc_main = {
  data() {
    return {
      loading: true,
      retry: 1
    };
  },
  components: { UserIcon },
  mounted() {
    self = this;
  },
  watch: {
    loading() {
    }
  },
  props: ["type", "src", "alt", "classes"],
  methods: {
    imageError: (e) => {
      self.loading = false;
      if (self.retry < 0)
        return;
      self.loading = true;
      if (self.type == "user")
        e.target.src = "/assets/images/def-user.png";
      else
        e.target.src = "/assets/images/noimage.png";
      self.retry--;
    }
  }
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  _push(`<img${ssrRenderAttrs(mergeProps({
    src: $props.src,
    alt: $props.alt,
    class: $props.classes + ($data.loading ? " animate-pulse bg-gray-200 " : " ")
  }, _attrs))}>`);
}
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/Image.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const Image = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  Image as I
};
