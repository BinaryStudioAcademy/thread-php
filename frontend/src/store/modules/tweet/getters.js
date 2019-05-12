import moment from 'moment';

export default {
    tweetsSortedByCreatedDate: state => Object.values(state.tweets).sort(
        (a, b) => (
            moment(a.created).isBefore(moment(b.created)) ? 1 : -1
        )
    ),

    getTweetById: state => id => state.tweets[id],

    isTweetOwner: (state, getters) => (tweetId, userId) => getters.getTweetById(tweetId).author.id === userId,
};
