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
                        <img :src="tweet.imageUrl" alt="Tweet image">
                    </figure>
                    <br>
                    <small><a>Like</a> · <a>Reply</a> · 3 hrs</small>
                </p>
            </div>
            <template v-for="comment in comments">
                <Comment
                    :key="comment.id"
                    :comment="comment"
                />
            </template>
            <NewCommentForm :tweetId="tweet.id" />
        </div>
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

    created() {
        this.fetchComments(this.tweet.id);
    },

    computed: {
        ...mapGetters('comment', [
            'comments'
        ])
    },

    methods: {
        ...mapActions('comment', [
            'fetchComments',
        ]),
    },
};
</script>

<style lang="scss" scoped>
.tweet-image {
    margin: 12px 0 0 0;

    img {
        width: auto;
    }
}
</style>
