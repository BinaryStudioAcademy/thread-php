<template>
    <div class="tweets-container">
        <template v-for="tweet in tweets">
            <TweetPreview
                :key="tweet.id"
                :tweet="tweet"
                @click="onTweetClick"
            />
        </template>
        <infinite-loading @infinite="infiniteHandler" ref="infiniteLoading" >
            <span slot="no-more" />
        </infinite-loading>
    </div>
</template>

<script>
import InfiniteLoading from 'vue-infinite-loading';
import TweetPreview from './TweetPreview.vue';

export default {
    name: 'TweetPreviewList',

    props: {
        tweets: {
            type: Array,
            required: true
        },
    },

    components: {
        TweetPreview,
        InfiniteLoading,
    },

    methods: {
        onTweetClick(tweet) {
            this.$router.push({ name: 'tweet-page', params: { id: tweet.id } });
        },

        infiniteHandler($state) {
            this.$emit('infinite', $state);
        },
    },
};
</script>

<style scoped lang="scss">
.tweets-container {
    padding-bottom: 20px;
}
</style>
