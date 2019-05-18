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
import showStatusToast from '@/components/mixin/showStatusToast';

export default {
    name: 'UserContainer',

    mixins: [showStatusToast],

    components: {
        TweetPreviewList,
        NoContent
    },

    data: () => ({
        tweets: [],
        page: 1,
    }),

    async created() {
        try {
            this.tweets = await this.fetchTweetsByUserId({ 
                userId: this.$route.params.id, 
                params: {
                    page: 1
                }
            });
        } catch (error) {
            this.showErrorMessage(error.message);
        }
    },

    methods: {
        ...mapActions('tweet', [
            'fetchTweetsByUserId',
        ]),

        async infiniteHandler($state) {
            try {
                const tweets = await this.fetchTweetsByUserId({
                    userId: this.$route.params.id,
                    params: {
                        page: this.page + 1
                    }
                });

                if (tweets.length) {
                    this.tweets.push(...tweets);
                    this.page += 1;
                    $state.loaded();
                } else {
                    $state.complete();
                }
            } catch (error) {
                this.showErrorMessage(error.message);
                $state.loaded();
            }
        },
    },
};
</script>

<style scoped>
</style>
