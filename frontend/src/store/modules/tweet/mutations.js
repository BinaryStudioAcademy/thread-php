import { SET_TWEETS, NEW_TWEET } from './mutationTypes';
import { tweetMapper } from '@/services/Normalizer';

export default {
    [SET_TWEETS]: (state, tweets) => {
        state.tweets = tweets.map(tweetMapper);
    },

    [NEW_TWEET]: (state, tweet) => {
        state.tweets.unshift(tweet);
    },
};
