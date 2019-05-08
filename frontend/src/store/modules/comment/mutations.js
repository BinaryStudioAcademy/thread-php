import { SET_COMMENTS, ADD_COMMENT } from './mutationTypes';
import { commentMapper } from '@/services/Normalizer';

export default {
    [SET_COMMENTS]: (state, { tweetId, comments }) => {
        state.comments = {
            ...state.comments,
            [tweetId]: comments.map(commentMapper)
        };
    },

    [ADD_COMMENT]: (state, { tweetId, comment }) => {
        state.comments = {
            ...state.comments,
            [tweetId]: [
                ...state.comments[tweetId],
                commentMapper(comment)
            ],
        };
    },
};
