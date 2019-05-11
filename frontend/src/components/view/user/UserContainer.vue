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
