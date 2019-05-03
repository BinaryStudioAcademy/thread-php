import Vue from 'vue';
import Router from 'vue-router';
import Storage from '@/services/Storage';
import store from './store';

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
            meta: { handleAuth: true },
        },
        {
            path: '/auth/sign-up',
            name: 'auth.signUp',
            component: SignUp,
            meta: { handleAuth: true },
        },
    ],
    scrollBehavior: () => ({ x: 0, y: 0 }),
});

// check auth routes
router.beforeEach(
    (to, from, next) => {
        const isAuthenticatedRoute = to.matched.some(record => record.meta.requiresAuth);
        const isAuthSectionRoute = to.matched.some(record => record.meta.handleAuth);

        if (isAuthenticatedRoute && !Storage.hasToken()) {
            next({ name: 'auth.signIn' });
            return;
        }

        if (isAuthSectionRoute && Storage.hasToken()) {
            next({ path: '/' });
            return;
        }

        next({ path: to });
    },
);

export default router;
