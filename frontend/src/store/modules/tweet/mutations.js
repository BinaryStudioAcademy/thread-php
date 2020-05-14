import { tweetMapper } from '@/services/Normalizer';
import {
    SET_TWEETS,
    SET_TWEET_IMAGE,
    SET_TWEET,
    DELETE_TWEET,
    INCREMENT_COMMENTS_COUNT,
    LIKE_TWEET,
    DISLIKE_TWEET
} from './mutationTypes';

export default {
    [SET_TWEETS]: (state, tweets) => {
        state.tweets = {
            ...state.tweets,
            ...tweets.reduce(
                (prev, tweet) => ({ ...prev, [tweet.id]: tweetMapper(tweet) }),
                {}
            ),
        };
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

    [LIKE_TWEET]: (state, { id, userId }) => {
        state.tweets[id].likesCount++;

        state.tweets[id].likes.push({ userId });
    },

    [DISLIKE_TWEET]: (state, { id, userId }) => {
        state.tweets[id].likesCount--;

        state.tweets[id].likes = state.tweets[id].likes.filter(like => like.userId !== userId);
    }
};
