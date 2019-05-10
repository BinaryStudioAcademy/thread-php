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
import { mapActions } from 'vuex';
import TweetPreview from '@/components/view/feed/TweetPreview.vue';

export default {
    name: 'UserContainer',

    components: {
        TweetPreview,
    },

    data: () => ({
        tweets: [],
    }),


    async created() {
        try {
            this.tweets = await this.fetchTweetsByUserId(this.$route.params.id);
        } catch (error) {
            console.error(error.message);
        }
    },

    methods: {
        ...mapActions('tweet', [
            'fetchTweetsByUserId',
        ]),

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
