import Vue from 'vue';
import Router from 'vue-router';
import Storage from '@/services/Storage';

// async components
const Feed = () => import(/* webpackChunkName: "feed" */ './views/Feed.vue');
const Profile = () => import(/* webpackChunkName: "profile" */ './views/Profile.vue');
const User = () => import(/* webpackChunkName: "user" */ './views/User.vue');

// auth pages using same chunk name
const SignIn = () => import(/* webpackChunkName: "auth" */ './views/SignIn.vue');
const SignUp = () => import(/* webpackChunkName: "auth" */ './views/SignUp.vue');

Vue.use(Router);

const router = new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
        {
            path: '/',
            redirect: '/feed',
            meta: { requiresAuth: true },
        },
        {
            path: '/feed',
            name: 'feed',
            component: Feed,
            meta: { requiresAuth: true },
        },
        {
            path: '/profile',
            name: 'profile',
            component: Profile,
            meta: { requiresAuth: true },
        },
        {
            path: '/users/:id',
            name: 'user-page',
            component: User,
            meta: { requiresAuth: true },
        },
        {
            path: '/auth/sign-in',
            name: 'auth.signIn',
            component: SignIn,
        },
        {
            path: '/auth/sign-up',
            name: 'auth.signUp',
            component: SignUp,
        },
    ],
    scrollBehavior: () => ({ x: 0, y: 0 }),
});

// check auth routes
router.beforeEach(
    (to, from, next) => {
        const isAuthenticatedRoute = to.matched.some(record => record.meta.requiresAuth);

        if (!isAuthenticatedRoute || Storage.hasToken()) {
            next();
            return;
        }

        next({ name: 'auth.signIn' });
    },
);

export default router;
