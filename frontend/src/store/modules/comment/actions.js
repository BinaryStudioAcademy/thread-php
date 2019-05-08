import api from '@/api/Api';
import { SET_LOADING } from '../../mutationTypes';
import { SET_COMMENTS, ADD_COMMENT } from './mutationTypes';

export default {
    async fetchComments({ commit }, tweetId) {
        commit(SET_LOADING, true, { root: true });

        try {
            const comments = await api.get(`/tweets/${tweetId}/comments`, {
                direction: 'asc',
            });

            commit(SET_COMMENTS, { tweetId, comments });
            commit(SET_LOADING, false, { root: true });

            return Promise.resolve();
        } catch (error) {
            commit(SET_LOADING, false, { root: true });

            return Promise.reject(error);
        }
    },

    async addComment({ commit }, { tweetId, text }) {
        commit(SET_LOADING, true, { root: true });

        try {
            const comment = await api.post('/comments', { tweet_id: tweetId, body: text });

            commit(ADD_COMMENT, { tweetId, comment });
            commit(SET_LOADING, false, { root: true });

            return Promise.resolve(comment);
        } catch (error) {
            commit(SET_LOADING, false, { root: true });

            return Promise.reject(error);
        }
    },
};
