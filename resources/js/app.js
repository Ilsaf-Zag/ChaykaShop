import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import AppLayout from "./layouts/AppLayout.vue";
import {ZiggyVue} from "../../vendor/tightenco/ziggy/dist/vue.m";
import '../css/app.css'
import { createPinia } from 'pinia'
import './WS.js';

const pinia = createPinia()

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        const page = pages[`./Pages/${name}.vue`]
        page.default.layout = page.default.layout || AppLayout
        return page
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(pinia)
            .mount(el)
    },
    progress:{
        color:'#ff335f',
    }
})
