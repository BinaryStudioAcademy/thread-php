export default {
    getCommentsByTweetId: state => tweetId => state.comments[tweetId] || [],
};
