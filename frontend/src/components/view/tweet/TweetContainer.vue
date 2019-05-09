<template>
    <div class="container">
        <Tweet v-if="tweet" :tweet="tweet" />
    </div>
</template>

<script>
import { mapActions } from 'vuex';
import Tweet from './Tweet.vue';

export default {
    name: 'TweetContainer',

    components: {
        Tweet,
    },

    data: () => ({
        tweet: null,
    }),

    async created() {
        try {
            this.tweet = await this.fetchTweetById(this.$route.params.id);
        } catch (error) {
            console.error(error.message);
        }
    },

    methods: {
        ...mapActions('tweet', [
            'fetchTweetById',
        ]),
    },
};
</script>

<style scoped lang="scss">
.container {
    max-width: 960px;
}
</style>
