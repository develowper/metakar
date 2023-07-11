import {usePage,} from "@inertiajs/vue3";
import {inject, ref, defineEmits} from 'vue'


export default {
    // emits: ['showToast'],
    // setup(props, ctx) {
    //     ctx.emit('showToast')
    // },

    data() {
        return {}
    },
    mounted() {
        // console.log(inject('toast'));

    },
    methods: {
        showToast(type, message) {
            this.emitter.emit('showToast', {type, message});

        },
        /**
         * Translate the given key.
         */
        __: (key, replace = {}) => {
            let $lang = usePage().props.language;

            var translation = $lang[key]
                ? $lang[key]
                : key

            Object.keys(replace).forEach(function (key) {
                translation = translation.replace(':' + key, replace[key])
            });

            return translation
        }, dir: () => {
            let $lang = usePage().props.language;
            if ($lang == 'en') return 'ltr'; else return 'rtl';

        }, log: (str) => {
            console.log(str);
        },
        asPrice(price) {
            return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },
    },


}
