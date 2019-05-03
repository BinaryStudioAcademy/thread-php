<template>
    <div class="tweets-container">
        <template v-for="tweet in tweets">
            <Tweet
                :key="tweet.id"
                :tweet="tweet"
            />
        </template>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import Tweet from '@/components/Tweet.vue';

export default {
    name: 'TweetContainer',

    components: {
        Tweet,
    },

    created() {
        this.fetchTweets();
    },

    computed: {
        ...mapGetters('tweet', [
            'tweets'
        ])
    },

    methods: {
        ...mapActions('tweet', [
            'fetchTweets'
        ])
    }
};
</script>

<style scoped lang="scss">
.tweets-container {
    padding-bottom: 20px;
}
</style>
