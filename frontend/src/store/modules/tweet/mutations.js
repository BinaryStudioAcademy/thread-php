import {
    SET_TWEETS,
    NEW_TWEET,
    SET_TWEET_IMAGE,
    SET_TWEET,
    DELETE_TWEET
} from './mutationTypes';
import { tweetMapper } from '@/services/Normalizer';

export default {
    [SET_TWEETS]: (state, tweets) => {
        tweets.forEach(tweet => {
            state.tweets = {
                ...state.tweets,
                [tweet.id]: tweetMapper(tweet)
            };
        });
    },

    [NEW_TWEET]: (state, tweet) => {
        state.tweets[tweet.id] = tweetMapper(tweet);
    },

    [SET_TWEET_IMAGE]: (state, { id, imageUrl }) => {
        state.tweets[id].imageUrl = imageUrl;
    },

    [SET_TWEET]: (state, tweet) => {
        state.tweets = {
            ...state.tweets,
            [tweet.id]: tweetMapper(tweet)
        };
    },

    [DELETE_TWEET]: (state, id) => {
        delete state.tweets[id];
    }
};
