<template>
    <div class="tweets-container">
        <transition-group name="slide-prev" tag="div">
            <template v-for="tweet in tweets">
                <TweetPreview
                    :key="tweet.id"
                    :tweet="tweet"
                    @click="onTweetClick"
                />
            </template>
        </transition-group>
    </div>
</template>

<script>
import TweetPreview from './TweetPreview.vue';

export default {
    name: 'TweetPreviewList',

    props: {
        tweets: {
            type: Array,
            required: true
        }
    },

    components: {
        TweetPreview,
    },

    methods: {
        onTweetClick(tweet) {
            this.$router.push({ name: 'tweet-page', params: { id: tweet.id } });
        },
    },
};
</script>

<style scoped lang="scss">
.tweets-container {
    padding-bottom: 20px;
}
</style>
