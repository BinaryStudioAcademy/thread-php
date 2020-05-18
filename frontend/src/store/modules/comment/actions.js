import api from '@/api/Api';
import { commentMapper } from '@/services/Normalizer';
import { SET_LOADING } from '../../mutationTypes';
import { SET_COMMENTS, ADD_COMMENT } from './mutationTypes';
import { INCREMENT_COMMENTS_COUNT } from '../tweet/mutationTypes';

export default {
    async fetchComments({ commit }, tweetId) {
        commit(SET_LOADING, true, { root: true });

        try {
            const comments = await api.get(`/tweets/${tweetId}/comments`, {
                direction: 'asc',
            });

            commit(SET_COMMENTS, comments);
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

            commit(ADD_COMMENT, comment);
            commit(`tweet/${INCREMENT_COMMENTS_COUNT}`, tweetId, { root: true });
            commit(SET_LOADING, false, { root: true });

            return Promise.resolve(commentMapper(comment));
        } catch (error) {
            commit(SET_LOADING, false, { root: true });

            return Promise.reject(error);
        }
    },
};
