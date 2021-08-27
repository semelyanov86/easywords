require('./bootstrap');

// @ts-ignore
import Alpine from 'alpinejs';
// @ts-ignore
window.Alpine = Alpine;

Alpine.start();

import { createApp } from 'vue';
// import { createRouter, createWebHistory } from 'vue-router';
import App from './App.vue';
// @ts-ignore
import WaveUI from 'wave-ui'
import 'wave-ui/dist/wave-ui.css'
import {i18n} from './plugins/vue-i18n-next-plugin'
import router from './router'

const app = createApp(App);

// @ts-ignore
app.use(i18n);
app.use(router);
new WaveUI(app, {
    // Some Wave UI options.
})
app.mount('#app');
