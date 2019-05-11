<template>
    <div>
        <article class="media box tweet">
            <figure class="media-left">
                <p v-if="tweet.author.avatar" class="image is-64x64 is-square">
                    <img class="is-rounded" :src="tweet.author.avatar">
                </p>
                <DefaultAvatar v-else class="image is-64x64" :user="tweet.author" />
            </figure>

            <div class="media-content">
                <div class="columns">
                    <div class="column">
                        <div class="content">
                            <p class="tweet-text">
                                <strong>{{ tweet.author.name }}</strong>
                                <br>
                                <small>
                                    {{ tweet.created | createdDate }}
                                </small>
                                <br>
                                {{ tweet.text }}
                                <br>
                                <a>Like</a>
                            </p>

                            <figure v-if="tweet.imageUrl" class="image is-3by1 tweet-image">
                                <img
                                    :src="tweet.imageUrl"
                                    alt="Tweet image"
                                    @click="showImageModal"
                                >
                            </figure>
                        </div>
                    </div>

                    <div v-if="isTweetOwner" class="column is-narrow is-12-mobile">
                        <div class="buttons">
                            <b-button type="is-warning" @click="onEditTweet">Edit</b-button>
                            <b-button type="is-danger" @click="onDeleteTweet">Delete</b-button>
                        </div>
                    </div>
                </div>

                <template v-for="comment in getCommentsByTweetId(tweet.id)">
                    <Comment
                        :key="comment.id"
                        :comment="comment"
                    />
                </template>

                <NewCommentForm :tweet-id="tweet.id" />
            </div>
        </article>

        <b-modal :active.sync="isImageModalActive">
            <p class="image is-4by3">
                <img :src="tweet.imageUrl">
            </p>
        </b-modal>

        <b-modal :active.sync="isEditTweetModalActive" has-modal-card>
            <EditTweetForm :tweet="tweet" />
        </b-modal>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import Comment from './Comment.vue';
import NewCommentForm from './NewCommentForm.vue';
import EditTweetForm from './EditTweetForm.vue';
import DefaultAvatar from '../../common/DefaultAvatar.vue';
import showStatusToast from '../../mixin/showStatusToast';

export default {
    name: 'TweetContainer',

    components: {
        Comment,
        NewCommentForm,
        EditTweetForm,
        DefaultAvatar,
    },

    mixins: [showStatusToast],

    data: () => ({
        isEditTweetModalActive: false,
        isImageModalActive: false
    }),

    async created() {
        try {
            await this.fetchTweetById(this.$route.params.id);

            this.fetchComments(this.tweet.id);
        } catch (error) {
            console.error(error.message);
        }
    },

    computed: {
        ...mapGetters('auth', {
            user: 'getAuthenticatedUser'
        }),

        ...mapGetters('tweet', [
            'getTweetById'
        ]),

        ...mapGetters('comment', [
            'getCommentsByTweetId'
        ]),

        tweet() {
            return this.getTweetById(this.$route.params.id);
        },

        isTweetOwner() {
            return this.user.id === this.tweet.author.id;
        }
    },

    methods: {
        ...mapActions('tweet', [
            'fetchTweetById',
            'deleteTweet',
        ]),

        ...mapActions('comment', [
            'fetchComments',
        ]),

        onEditTweet() {
            this.isEditTweetModalActive = true;
        },

        onDeleteTweet() {
            this.$dialog.confirm({
                title: 'Deleting tweet',
                message: 'Are you sure you want to <b>delete</b> your tweet? This action cannot be undone.',
                confirmText: 'Delete Tweet',
                type: 'is-danger',

                onConfirm: async () => {
                    try {
                        await this.deleteTweet(this.tweet.id);

                        this.showSuccessMessage('Tweet deleted!');

                        this.$router.push({ name: 'feed' });
                    } catch {
                        this.showErrorMessage('Unable to delete tweet!');
                    }
                }
            });
        },

        showImageModal() {
            this.isImageModalActive = true;
        },
    },
};
</script>

<style lang="scss" scoped>
@import "~bulma/sass/utilities/initial-variables";

.tweet-image {
    margin: 12px 0 0 0;

    img {
        width: auto;
        cursor: pointer;
    }
}

.buttons {
    .button {
        @media screen and (max-width: $tablet) {
            font-size: 0.8rem;
        }
    }
}

.tweet-text {
    max-width: 100%;
}
</style>
