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
            <NewCommentForm />
        </div>
    </article>
</template>

<script>
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

    // get tweet comments

    data: () => ({
        comments: [
            {
                id: 1,
                body: 'Test comment 1',
                created: '3h',
                author: {
                    id: 1,
                    name: 'Author 1',
                    avatar: 'https://bulma.io/images/placeholders/96x96.png',
                },
            },
        ],
    }),
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
