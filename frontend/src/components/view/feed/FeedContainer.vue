<template>
    <div class="tweets-container">
        <div class="navigation">
            <b-button
                class="btn-add-tweet"
                rounded
                size="is-medium"
                type="is-primary"
                icon-left="twitter"
                icon-pack="fab"
                @click="onAddTweetClick"
            >
                Tweet :)
            </b-button>
        </div>

        <template v-for="tweet in tweets">
            <TweetPreview
                :key="tweet.id"
                :tweet="tweet"
                @click="onTweetClick"
                @image-click="onTweetImageClick"
            />
        </template>

        <b-modal :active.sync="isNewTweetModalActive" has-modal-card>
            <NewTweetForm />
        </b-modal>

        <b-modal :active.sync="isImageModalActive">
            <p class="image is-4by3">
                <img :src="currentImageUrl">
            </p>
        </b-modal>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import TweetPreview from './TweetPreview.vue';
import NewTweetForm from './NewTweetForm.vue';

export default {
    name: 'FeedContainer',

    components: {
        TweetPreview,
        NewTweetForm,
    },

    data: () => ({
        isNewTweetModalActive: false,
        isImageModalActive: false,
        currentImageUrl: null,
    }),

    created() {
        this.fetchTweets();
    },

    computed: {
        ...mapGetters('tweet', [
            'tweets'
        ]),
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

        onTweetClick(tweet) {
            this.$router.push({ name: 'tweet-page', params: { id: tweet.id } });
        },

        onTweetImageClick(tweet, event) {
            event.stopPropagation();
            this.currentImageUrl = tweet.imageUrl;
            this.showTweetImageModal();
        },

        showTweetImageModal() {
            this.isImageModalActive = true;
        },
    },
};
</script>

<style scoped lang="scss">
@import '~bulma/sass/utilities/initial-variables';

.tweets-container {
    padding-bottom: 20px;

    .tweet {
        transition: 0.2s ease-out all;

        &:hover {
            box-shadow: 1px 1px 0 0 #00000020;
        }
    }

    .navigation {
        padding: 10px 0;
        margin-bottom: 20px;
    }

    .modal-card {
        border-radius: 6px;
    }

    .btn-add-tweet {
        @media screen and (max-width: $tablet) {
            font-size: 1rem;
        }
    }
}
</style>
