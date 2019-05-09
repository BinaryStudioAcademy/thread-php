<template>
    <article class="media">
        <figure class="media-left">
            <p class="image is-48x48 is-square">
                <img class="is-rounded" :src="user.avatar">
            </p>
        </figure>
        <div class="media-content">
            <div class="field">
                <p class="control">
                    <textarea
                        class="textarea"
                        v-model="text"
                        placeholder="Add a comment..."
                    />
                </p>
            </div>
            <div class="field">
                <p class="control">
                    <button
                        class="button is-primary"
                        :disabled="!text.trim()"
                        @click="onPostComment"
                    >
                        Post comment
                    </button>
                </p>
            </div>
        </div>
    </article>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';

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

    computed: {
        ...mapGetters('auth', {
            user: 'getAuthenticatedUser'
        }),
    },

    methods: {
        ...mapActions('comment', [
            'addComment',
        ]),

        clearInput() {
            this.text = '';
        },

        async onPostComment() {
            await this.addComment({
                tweetId: this.tweetId,
                text: this.text,
            });
            this.clearInput();
        },
    },
};
</script>

<style lang="scss" scoped>
.textarea {
    min-height: 60px;
}
</style>
