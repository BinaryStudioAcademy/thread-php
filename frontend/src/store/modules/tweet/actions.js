import { SET_TWEETS } from './mutationTypes';
import { SET_LOADING } from '../../mutationTypes';
import api from '@/api/Api';

export default {
    async fetchTweets({ commit }) {
        commit(SET_LOADING, true, { root: true });

        try {
            const data = await api.get('/tweets');

            commit(SET_TWEETS, data);
            commit(SET_LOADING, false, { root: true });

            return Promise.resolve();
        } catch (error) {
            commit(SET_LOADING, false, { root: true });

            return Promise.reject(error);
        }
    },
};
