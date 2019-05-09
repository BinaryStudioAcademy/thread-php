import {
    SET_TWEETS,
    NEW_TWEET,
    SET_TWEET_IMAGE,
    EDIT_TWEET
} from './mutationTypes';
import { tweetMapper } from '@/services/Normalizer';

export default {
    [SET_TWEETS]: (state, tweets) => {
        state.tweets = tweets.map(tweetMapper);
    },

    [NEW_TWEET]: (state, tweet) => {
        state.tweets.unshift(tweetMapper(tweet));
    },

    [SET_TWEET_IMAGE]: (state, { id, imageUrl }) => {
        const tweet = state.tweets.find(tw => tw.id === id);

        if (tweet) {
            tweet.imageUrl = imageUrl;
        }
    },

    [EDIT_TWEET]: (state, { id, text }) => {
        let updatedTweet = state.tweets.find(tw => tw.id === id);

        updatedTweet = {
            ...updatedTweet,
            text
        };
    },
};
