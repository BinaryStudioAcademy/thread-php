<template>
    <div class="feed-container">
        <div class="navigation">
            <b-button
                class="btn-add-tweet"
                rounded
                size="is-medium"
                type="is-danger"
                icon-left="twitter"
                icon-pack="fab"
                @click="onAddTweetClick"
            >
                Tweet :)
            </b-button>
        </div>

        <TweetPreviewList :tweets="tweets" />

        <b-modal :active.sync="isNewTweetModalActive" has-modal-card>
            <NewTweetForm />
        </b-modal>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import TweetPreviewList from '../../common/TweetPreviewList.vue';
import NewTweetForm from './NewTweetForm.vue';

export default {
    name: 'FeedContainer',

    components: {
        TweetPreviewList,
        NewTweetForm,
    },

    data: () => ({
        isNewTweetModalActive: false,
    }),

    async created() {
        try {
            await this.fetchTweets();
        } catch (error) {
            console.error(error.message);
        }
    },

    computed: {
        ...mapGetters('tweet', {
            tweets: 'tweetsSortedByCreatedDate'
        }),
    },

    methods: {
        ...mapActions('tweet', [
            'fetchTweets',
        ]),

        onAddTweetClick() {
            this.showAddTweetModal();
        },

        showAddTweetModal() {
            this.isNewTweetModalActive = true;
        },
    },
};
</script>

<style scoped lang="scss">
@import '~bulma/sass/utilities/initial-variables';

.navigation {
    padding: 10px 0;
    margin-bottom: 20px;
}

.modal-card {
    border-radius: 6px;
}

.btn-add-tweet {
    transition: 0.2s ease-out all;
    box-shadow: 1px 5px 5px 0 #00000020;

    &:hover {
        box-shadow: 1px 1px 0 0 #00000020;
    }

    @media screen and (max-width: $tablet) {
        font-size: 1rem;
    }
}
</style>
