import { createRouter, createWebHashHistory, RouteRecordRaw } from 'vue-router';

const routes: Array<RouteRecordRaw> = [
    {
        path: '/',
        name: 'Home',
        component: () => import(/* webpackChunkName: "about" */ '../views/Home.vue'),
    },
    {
        path: '/login',
        name: 'Login',
        component: () => import(/* webpackChunkName: "about" */ '../views/Login.vue'),
    },
    {
        path: '/logout',
        name: 'Logout',
        component: () => import(/* webpackChunkName: "about" */ '../views/Logout.vue'),
    },
    {
        path: '/settings',
        name: 'Settings',
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import(/* webpackChunkName: "about" */ '../views/Settings.vue'),
    },
    {
        path: '/statistics',
        name: 'Statistics',
        component: () => import(/* webpackChunkName: "about" */ '../views/Statistics.vue'),
    },
    {
        path: '/known',
        name: 'KnownWords',
        component: () => import(/* webpackChunkName: "about" */ '../views/KnownWords.vue'),
    },
    {
        path: '/profile',
        name: 'Profile',
        component: () => import(/* webpackChunkName: "about" */ '../views/Profile.vue'),
    },
    {
        path: '/create',
        name: 'Create',
        component: () => import(/* webpackChunkName: "about" */ '../views/Create.vue'),
    },
    {
        path: '/user/password',
        name: 'ChangePassword',
        component: () => import(/* webpackChunkName: "about" */ '../views/ChangePassword.vue'),
    },
    {
        path: '/words/:parent/:target/:rev',
        name: 'Words',
        props: true,
        component: () => import(/* webpackChunkName: "about" */ '../views/Words.vue'),
    },
];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

export default router;
