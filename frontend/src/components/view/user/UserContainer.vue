<template>
    <div class="user-container">
        <TweetPreviewList :tweets="tweets" />
        <NoContent :show="!tweets.length" title="No tweets yet :)" />
    </div>
</template>

<script>
import { mapActions } from 'vuex';
import TweetPreviewList from '@/components/common/TweetPreviewList.vue';
import NoContent from '@/components/common/NoContent.vue';

export default {
    name: 'UserContainer',

    components: {
        TweetPreviewList,
        NoContent
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
