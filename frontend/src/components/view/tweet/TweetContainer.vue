<template>
    <div class="container">
        <Tweet v-if="tweet" :tweet="tweet" />
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import Tweet from './Tweet.vue';

export default {
    name: 'TweetContainer',

    components: {
        Tweet,
    },

    computed: {
        ...mapGetters('tweet', [
            'getTweetById'
        ]),

        tweet() {
            return this.getTweetById(this.$route.params.id);
        }
    },

    created() {
        this.fetchTweetById(this.$route.params.id);
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
