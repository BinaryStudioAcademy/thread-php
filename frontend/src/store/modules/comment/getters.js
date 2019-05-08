export default {
    getComments: state => tweetId => state.comments[tweetId] || [],
};
