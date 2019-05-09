export default {
    // @todo sort data by created date
    tweets: state => Object.values(state.tweets),
    getTweetById: state => id => state.tweets[id]
};
