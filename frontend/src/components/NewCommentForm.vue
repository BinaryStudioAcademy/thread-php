<template>
    <article class="media">
        <figure class="media-left">
            <p class="image is-48x48 is-square">
                <img class="is-rounded" src="https://bulma.io/images/placeholders/128x128.png">
            </p>
        </figure>
        <div class="media-content">
            <div class="field">
                <p class="control">
                    <textarea
                        class="textarea"
                        v-model="text"
                        placeholder="Add a comment..."
                    >
                    </textarea>
                </p>
            </div>
            <div class="field">
                <p class="control">
                    <button class="button" @click="handlePostComment">Post comment</button>
                </p>
            </div>
        </div>
    </article>
</template>

<script>
import { mapActions } from 'vuex';

export default {
    name: 'NewCommentForm',

    props: {
        tweetId: {
            type: Number,
            required: true,
        },
    },

    data: () => ({
        text: '',
    }),

    methods: {
        ...mapActions('comment', [
            'addComment',
        ]),

        async handlePostComment() {
            await this.addComment({
                tweetId: this.tweetId,
                text: this.text,
            });
        },
    },
}
</script>

<style lang="scss" scoped>
.textarea {
    min-height: 60px;
}
</style>

