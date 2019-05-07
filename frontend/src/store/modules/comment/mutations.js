import { SET_COMMENTS } from './mutationTypes';
import { commentMapper } from '@/services/Normalizer';

export default {
    [SET_COMMENTS]: (state, comments) => {
        state.comments = comments.map(commentMapper);
    },
};
