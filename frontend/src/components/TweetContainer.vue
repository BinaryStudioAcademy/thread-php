<template>
    <div class="tweets-container">
        <div class="navigation">
            <b-button
                rounded
                size="is-medium"
                type="is-primary"
                icon-left="twitter"
                icon-pack="fab"
                @click="onAddTweet"
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
            <NewTweetForm :on-save="newTweet" />
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
            'fetchTweets'
        ]),

        onAddTweet() {
            this.showAddTweetModal();
        },

        showAddTweetModal() {
            this.isModalActive = true;
        },

        newTweet({ text, image }) {
            console.log(text, image);
        }
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
