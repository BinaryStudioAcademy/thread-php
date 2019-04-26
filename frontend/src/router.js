import Vue from 'vue';
import Router from 'vue-router';
import Home from './views/Home';
import Feed from './views/Feed';

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
  ],
});
