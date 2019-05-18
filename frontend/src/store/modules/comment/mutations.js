import { SET_COMMENTS, ADD_COMMENT } from './mutationTypes';
import { commentMapper } from '@/services/Normalizer';

export default {
    [SET_COMMENTS]: (state, comments) => {
        let commentsByIdMap = {};

        comments.forEach(comment => {
            commentsByIdMap = {
                ...commentsByIdMap,
                [comment.id]: commentMapper(comment)
            };
        });

        state.comments = commentsByIdMap;
    },

    [ADD_COMMENT]: (state, comment) => {
        state.comments = {
            ...state.comments,
            [comment.id]: commentMapper(comment)
        };
    },
};
