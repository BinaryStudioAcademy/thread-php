import moment from 'moment';

export default {
    getCommentsSortedByCreatedDateAsc: state => Object
        .values(state.comments)
        .sort(
            (a, b) => (
                moment(a.created).isBefore(moment(b.created)) ? -1 : 1
            )
        ),

    getCommentsByTweetId: (state, getters) => tweetId => getters
        .getCommentsSortedByCreatedDateAsc
        .filter(comment => comment.tweetId === tweetId),

    tweetIsCommentedByUser: (state, getters) => (tweetId, userId) => getters
        .getCommentsByTweetId(tweetId)
        .find(comment => comment.authorId === userId),
};
