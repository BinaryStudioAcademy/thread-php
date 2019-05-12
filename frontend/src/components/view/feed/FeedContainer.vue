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

        <NoContent :show="!tweets.length" title="No tweets yet :)" />

        <TweetPreviewList :tweets="tweets" />

        <b-modal :active.sync="isNewTweetModalActive" has-modal-card>
            <NewTweetForm />
        </b-modal>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import TweetPreviewList from '../../common/TweetPreviewList.vue';
import NoContent from '../../common/NoContent.vue';
import NewTweetForm from './NewTweetForm.vue';

export default {
    name: 'FeedContainer',

    components: {
        TweetPreviewList,
        NewTweetForm,
        NoContent
    },

    data: () => ({
        isNewTweetModalActive: false,
    }),

    created() {
        this.fetchTweets();
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
