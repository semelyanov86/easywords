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

const app = createApp(App);

app.use(BalmUI); // Mandatory
app.use(BalmUIPlus); // Optional

app.mount('#app');
