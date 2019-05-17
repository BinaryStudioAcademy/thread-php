<template>
    <div class="user-container">
        <TweetPreviewList :tweets="tweets" @infinite="infiniteHandler" />
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
        page: 1,
    }),

    methods: {
        ...mapActions('tweet', [
            'fetchTweetsByUserId',
        ]),

        async infiniteHandler($state) {
            try {
                const tweets = await this.fetchTweetsByUserId({
                    userId: this.$route.params.id,
                    params: { 
                        page: this.page
                    }
                });

                if (tweets.length) {
                    this.tweets.push(...tweets);
                    this.page++;
                    $state.loaded();
                } else {
                    $state.complete();
                }
            } catch (error) {
                console.error(error);
                $state.loaded();
            }
        },
    },
};
</script>

<style scoped>
</style>
