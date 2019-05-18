import {
    SET_TWEETS,
    SET_TWEET_IMAGE,
    SET_TWEET,
    DELETE_TWEET,
    INCREMENT_COMMENTS_COUNT,
    LIKE_OR_DISLIKE_TWEET
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
    },

    [INCREMENT_COMMENTS_COUNT]: (state, id) => {
        state.tweets[id].commentsCount++;
    },

    [LIKE_OR_DISLIKE_TWEET]: (state, id) => {
        state.tweets[id].likesCount++;
    }
};
