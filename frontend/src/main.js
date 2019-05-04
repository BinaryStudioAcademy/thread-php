import Vue from 'vue';
import Buefy from 'buefy';
import { library } from '@fortawesome/fontawesome-svg-core';
import {
    faHeart,
    faAngleDown,
    faComments,
    faShare,
    faUpload,
} from '@fortawesome/free-solid-svg-icons';
import {
    faTwitter
} from '@fortawesome/free-brands-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import createFilters from './components/filter/filters';
import router from './router';
import store from './store';
import App from './App.vue';

library.add(
    faHeart,
    faAngleDown,
    faComments,
    faShare,
    faTwitter,
    faUpload
);

Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.config.productionTip = false;
Vue.use(Buefy, {
    defaultIconComponent: 'font-awesome-icon'
});

createFilters(Vue);

new Vue({
    router,
    store,
    render: h => h(App),
}).$mount('#app');
