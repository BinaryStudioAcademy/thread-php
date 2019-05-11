<template>
    <TweetPreviewList :tweets="tweets" />
</template>

<script>
import { mapActions } from 'vuex';
import TweetPreviewList from '@/components/common/TweetPreviewList.vue';

export default {
    name: 'UserContainer',

    components: {
        TweetPreviewList,
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
    },
};
</script>

<style scoped>
</style>
