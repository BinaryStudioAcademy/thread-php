import Vue from 'vue';
import Vuex from 'vuex';
import state from './store/state';
import mutations from './store/mutations';
import getters from './store/getters';
import actions from './store/actions';
import auth from './store/modules/auth';
import tweet from './store/modules/tweet';
import comment from './store/modules/comment';

Vue.use(Vuex);

export default new Vuex.Store({
    strict: process.env.NODE_ENV !== 'production',
    state,
    mutations,
    actions,
    getters,
    modules: {
        auth,
        tweet,
        comment,
    },
});
