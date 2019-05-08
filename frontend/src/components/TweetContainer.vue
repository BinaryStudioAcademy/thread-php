<template>
    <div class="tweets-container box">
        <Tweet v-if="tweet" :tweet="tweet" />
    </div>
</template>

<script>
import { mapActions } from 'vuex';
import { tweetMapper } from '@/services/Normalizer';
import Tweet from '@/components/Tweet.vue';

export default {
    name: 'TweetContainer',

    components: {
        Tweet,
    },

    data: () => ({
        tweet: null,
    }),

    async created() {
        this.tweet = tweetMapper(
            await this.fetchTweetById(this.$route.params.id)
        );
    },

    methods: {
        ...mapActions('tweet', [
            'fetchTweetById',
        ]),
    },
};
</script>

<style scoped lang="scss">

</style>
