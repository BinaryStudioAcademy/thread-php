import { SET_TWEETS } from './mutationTypes';
import { tweetMapper } from '@/services/Normalizer';

export default {
    [SET_TWEETS]: (state, tweets) => {
        state.tweets = tweets.map(tweetMapper);
    },
};
