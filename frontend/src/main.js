import Vue from 'vue';
import Buefy from 'buefy';
import { library } from '@fortawesome/fontawesome-svg-core';
import {
    faHeart,
    faAngleDown,
    faComments,
    faShare,
} from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import router from './router';
import store from './store';
import App from './App.vue';
import 'buefy/dist/buefy.css';

library.add(faHeart, faAngleDown, faComments, faShare);
Vue.component('font-awesome-icon', FontAwesomeIcon);

Vue.config.productionTip = false;
Vue.use(Buefy);

new Vue({
    router,
    store,
    render: h => h(App),
}).$mount('#app');
