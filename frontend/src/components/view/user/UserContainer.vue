<template>
    <div class="user-container">
        <TweetPreviewList :tweets="tweets" />
        <NoContent :show="noContent" title="No tweets yet :)" />
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
        noContent: false
    }),

    async created() {
        try {
            this.tweets = await this.fetchTweetsByUserId(this.$route.params.id);

            if (!this.tweets.length) {
                this.noContent = true;
            }
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
