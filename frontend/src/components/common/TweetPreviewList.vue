<template>
    <div class="tweets-container">
        <template v-for="tweet in tweets">
            <TweetPreview
                :key="tweet.id"
                :tweet="tweet"
                @click="onTweetClick"
            />
        </template>
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

    data: () => ({
        tweets: [],
    }),

    methods: {
        onTweetClick(tweet, event) {
            event.stopPropagation();
            this.$router.push({ name: 'tweet-page', params: { id: tweet.id } });
        },
    },
};
</script>

<style scoped lang="scss">
.tweets-container {
    padding-bottom: 20px;

    .tweet {
        transition: 0.2s ease-out all;

        &:hover {
            background: #faf9ff;
        }
    }
}
</style>
