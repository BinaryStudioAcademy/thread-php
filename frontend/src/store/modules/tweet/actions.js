import {
    SET_TWEETS,
    NEW_TWEET,
    SET_TWEET_IMAGE,
    SET_TWEET,
    DELETE_TWEET
} from './mutationTypes';
import { SET_LOADING } from '../../mutationTypes';
import api from '@/api/Api';
import { tweetMapper } from '@/services/Normalizer';

export default {
    async fetchTweets({ commit }) {
        commit(SET_LOADING, true, { root: true });

        try {
            const data = await api.get('/tweets');

            commit(SET_TWEETS, data);
            commit(SET_LOADING, false, { root: true });

            return Promise.resolve();
        } catch (error) {
            commit(SET_LOADING, false, { root: true });

            return Promise.reject(error);
        }
    },

    async fetchTweetsByUserId({ commit }, userId) {
        commit(SET_LOADING, true, { root: true });

        try {
            const tweets = await api.get(`/users/${userId}/tweets`);

            commit(SET_LOADING, false, { root: true });

            return Promise.resolve(
                tweets.map(tweetMapper)
            );
        } catch (error) {
            commit(SET_LOADING, false, { root: true });

            return Promise.reject(error);
        }
    },

    async fetchTweetById({ commit }, tweetId) {
        commit(SET_LOADING, true, { root: true });

        try {
            const tweet = await api.get(`/tweets/${tweetId}`);

            commit(SET_LOADING, false, { root: true });
            commit(SET_TWEET, tweet);

            return Promise.resolve(tweetMapper(tweet));
        } catch (error) {
            commit(SET_LOADING, false, { root: true });

            return Promise.reject(error);
        }
    },

    async addTweet({ commit }, text) {
        commit(SET_LOADING, true, { root: true });

        try {
            const tweet = await api.post('/tweets', { text });

            commit(NEW_TWEET, tweet);
            commit(SET_LOADING, false, { root: true });

            return Promise.resolve(tweetMapper(tweet));
        } catch (error) {
            commit(SET_LOADING, false, { root: true });

            return Promise.reject(error);
        }
    },

    async uploadTweetImage({ commit }, { id, imageFile }) {
        commit(SET_LOADING, true, { root: true });

        try {
            const formData = new FormData();
            formData.append('image', imageFile);

            const tweet = await api.post(`/tweets/${id}/image`, formData);

            commit(SET_TWEET_IMAGE, {
                id,
                imageUrl: tweet.image_url
            });

            commit(SET_LOADING, false, { root: true });

            return Promise.resolve();
        } catch (error) {
            commit(SET_LOADING, false, { root: true });

            return Promise.reject(error);
        }
    },

    async editTweet({ commit }, { id, text }) {
        commit(SET_LOADING, true, { root: true });

        try {
            const tweet = await api.put(`/tweets/${id}`, { text });

            commit(SET_TWEET, tweet);
            commit(SET_LOADING, false, { root: true });

            return Promise.resolve(tweetMapper(tweet));
        } catch (error) {
            commit(SET_LOADING, false, { root: true });

            return Promise.reject(error);
        }
    },

    async deleteTweet({ commit }, id) {
        commit(SET_LOADING, true, { root: true });

        try {
            await api.delete(`/tweets/${id}`);

            commit(DELETE_TWEET, id);
            commit(SET_LOADING, false, { root: true });

            return Promise.resolve();
        } catch (error) {
            commit(SET_LOADING, false, { root: true });

            return Promise.reject(error);
        }
    },
};
