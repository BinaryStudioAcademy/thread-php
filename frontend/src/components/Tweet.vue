<template>
    <article class="media">
        <figure class="media-left">
            <p class="image is-64x64">
                <img :src="tweet.author.avatar">
            </p>
        </figure>
        <div class="media-content">
            <div class="content">
                <p>
                    <strong>{{ tweet.author.name }}</strong>
                    <br>
                    {{ tweet.text }}
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

        </div>
    </article>
    <!-- <article class="media">
        <figure class="media-left">
            <p class="image is-64x64">
            <img src="https://bulma.io/images/placeholders/128x128.png">
            </p>
        </figure>
        <div class="media-content">
            <div class="field">
            <p class="control">
                <textarea class="textarea" placeholder="Add a comment..."></textarea>
            </p>
            </div>
            <div class="field">
            <p class="control">
                <button class="button">Post comment</button>
            </p>
            </div>
        </div>
    </article> -->
</template>

<script>
import Comment from './Comment.vue';

export default {
    name: 'Tweet',

    components: {
        Comment,
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

</style>
