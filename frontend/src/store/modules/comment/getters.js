export default {
    getCommentsByTweetId: state => tweetId => state.comments[tweetId] || [],

    tweetIsCommentedByUser: (state, getters) => (tweetId, userId) => getters
        .getCommentsByTweetId(tweetId)
        .find(comment => comment.authorId === userId),
};
