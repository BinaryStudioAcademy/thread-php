<template>
    <div class="tweets-container">
        <div class="navigation">
            <b-button
                rounded
                size="is-medium"
                type="is-primary"
                icon-left="twitter"
                icon-pack="fab"
                @click="onAddTweetClick"
            >
                New Tweet :)
            </b-button>
        </div>

        <template v-for="tweet in tweets">
            <Tweet
                :key="tweet.id"
                :tweet="tweet"
            />
        </template>

        <b-modal :active.sync="isModalActive" has-modal-card>
            <NewTweetForm />
        </b-modal>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import Tweet from '@/components/Tweet.vue';
import NewTweetForm from '@/components/NewTweetForm.vue';

export default {
    name: 'TweetContainer',

    components: {
        Tweet,
        NewTweetForm
    },

    data: () => ({
        isModalActive: false,
    }),

    created() {
        this.fetchTweets();
    },

    computed: {
        ...mapGetters('tweet', [
            'tweets'
        ])
    },

    methods: {
        ...mapActions('tweet', [
            'fetchTweets',
        ]),

        onAddTweetClick() {
            this.showAddTweetModal();
        },

        showAddTweetModal() {
            this.isModalActive = true;
        },
    }
};
</script>

<style scoped lang="scss">
.tweets-container {
    padding-bottom: 20px;
}

.navigation {
    padding: 10px 0;
    margin-bottom: 20px;
}
</style>
