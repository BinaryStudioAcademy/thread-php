<template>
    <article class="tweet media">
        <figure class="media-left">
            <p class="image is-64x64 is-square">
                <img class="is-rounded" :src="tweet.author.avatar">
            </p>
        </figure>

        <div class="media-content">
            <div class="content">
                <p>
                    <strong>{{ tweet.author.name }}</strong>
                    <br>
                    {{ tweet.text }}
                    <br>
                    <figure v-if="tweet.imageUrl" class="image is-3by1 tweet-image">
                        <img 
                            :src="tweet.imageUrl"
                            alt="Tweet image"
                            @click="showImageModal"
                        >
                    </figure>
                    <br>
                    <small><a>Like</a> · <a>Reply</a> · {{ tweet.created | createdDate }}</small>
                </p>
            </div>

            <template v-for="comment in getCommentsByTweetId(tweet.id)">
                <Comment
                    :key="comment.id"
                    :comment="comment"
                />
            </template>

            <NewCommentForm :tweetId="tweet.id" />
        </div>

        <b-modal :active.sync="isImageModalActive">
            <p class="image is-4by3">
                <img :src="tweet.imageUrl">
            </p>
        </b-modal>
    </article>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import Comment from './Comment.vue';
import NewCommentForm from './NewCommentForm.vue';

export default {
    name: 'Tweet',

    components: {
        Comment,
        NewCommentForm,
    },

    props: {
        tweet: {
            type: Object,
            required: true,
        },
    },

    data: () => ({
        isImageModalActive: false,
    }),

    created() {
        this.fetchComments(this.tweet.id);
    },

    computed: {
        ...mapGetters('comment', [
            'getCommentsByTweetId'
        ]),
    },

    methods: {
        ...mapActions('comment', [
            'fetchComments',
        ]),

        showImageModal() {
            this.isImageModalActive = true;
        },
    },
};
</script>

<style lang="scss" scoped>
.tweet-image {
    margin: 12px 0 0 0;

    img {
        width: auto;
        cursor: pointer;
    }
}
</style>
