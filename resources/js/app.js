import './bootstrap';
import '../css/app.css';
import '../scss/app.scss';
import 'tw-elements';
import {createApp, h} from 'vue';
import {createInertiaApp} from '@inertiajs/vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {ZiggyVue} from '../../vendor/tightenco/ziggy/dist/vue.m';
import Mixins from "@/vue-mixins";
import LoadScript from 'vue-plugin-load-script';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({el, App, props, plugin}) {
        window.Vue = createApp({render: () => h(App, props)})
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(LoadScript)
            .mixin(Mixins)
            .mount(el);
        return window.Vue;
    },
    progress: {
        color: '#aa1111',
    },
});
