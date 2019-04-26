import Vue from 'vue';
import Router from 'vue-router';
import Home from './views/Home.vue';
import Feed from './views/Feed.vue';

Vue.use(Router);

export default new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/feed',
            name: 'feed',
            component: Feed,
        },
        {
            path: '/',
            name: 'home',
            // route level code-splitting
            // this generates a separate chunk (about.[hash].js) for this route
            // which is lazy-loaded when the route is visited.
            component: () => import(/* webpackChunkName: "about" */ './views/Home.vue'),
        },
        {
            path: '/feed',
            name: 'feed',
            component: () => import(/* webpackChunkName: "about" */ './views/Feed.vue'),
        },
        {
            path: '/profile',
            name: 'profile',
            component: () => import(/* webpackChunkName: "about" */ './views/Profile.vue'),
        },
    ],
});
