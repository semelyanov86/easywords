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
import BalmUI from 'balm-ui'; // Official Google Material Components
// @ts-ignore
import BalmUIPlus from 'balm-ui/dist/balm-ui-plus'; // BalmJS Team Material Components
import {i18n} from './plugins/vue-i18n-next-plugin'
import router from './router'

const app = createApp(App);

app.use(BalmUI); // Mandatory
app.use(BalmUIPlus); // Optional
// @ts-ignore
app.use(i18n);
app.use(router);

app.mount('#app');
