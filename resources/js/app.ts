import '../css/app.css';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { DefineComponent } from 'vue';
import { createApp, h } from 'vue';
import define_layout from './lib/utils';
import { createPinia } from 'pinia';
import { createVfm } from 'vue-final-modal';
import Vue3Toastify from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
const pinia = createPinia()
const vfm = createVfm()
createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    resolve: async (name) =>
        define_layout(await resolvePageComponent(`./pages/${name}.vue`, import.meta.glob<DefineComponent>('./pages/**/*.vue')), name),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(Vue3Toastify)
            .use(vfm)
            .use(pinia)
            .mount(el);
    },
    progress: {
        color: 'var(--color-red-500)',
    },
});
