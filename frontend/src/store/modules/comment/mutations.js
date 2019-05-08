import { SET_COMMENTS } from './mutationTypes';
import { commentMapper } from '@/services/Normalizer';

export default {
    [SET_COMMENTS]: (state, { tweetId, comments }) => {
        state.comments = {
            ...state.comments,
            [tweetId]: comments.map(commentMapper)
        };
    },
};
