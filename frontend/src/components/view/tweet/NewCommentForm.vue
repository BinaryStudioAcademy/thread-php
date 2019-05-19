<template>
    <article class="media">
        <figure class="media-left">
            <p class="image is-48x48 is-square" v-if="user.avatar">
                <img class="is-rounded fit" :src="user.avatar">
            </p>
            <DefaultAvatar v-else class="image is-48x48" :user="user" />
        </figure>
        <div class="media-content">
            <div class="field">
                <p class="control">
                    <textarea
                        class="textarea"
                        v-model="text"
                        placeholder="Add a comment..."
                        @keyup.ctrl.exact.enter="onPostComment"
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
import DefaultAvatar from '@/components/common/DefaultAvatar.vue';

export default {
    name: 'NewCommentForm',

    components: {
        DefaultAvatar,
    },

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
