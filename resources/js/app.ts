import './bootstrap';

// @ts-ignore
import Alpine from 'alpinejs';
// @ts-ignore
window.Alpine = Alpine;

Alpine.start();

import { createApp } from 'vue';
// import { createRouter, createWebHistory } from 'vue-router';
import App from './App.vue';

import {i18n} from './plugins/vue-i18n-next-plugin'
import router from './router'
import { FlagIconsScss } from './plugins/flags-icons/'

const app = createApp(App);

// @ts-ignore
app.use(i18n);
app.use(router);
app.use(FlagIconsScss);
app.mount('#app');
