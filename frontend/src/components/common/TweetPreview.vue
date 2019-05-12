<template>
    <div class="tweet box" @click="$emit('click', tweet)">
        <article class="media">
            <figure class="media-left">
                <router-link
                    v-if="tweet.author.avatar"
                    class="image is-64x64 is-square"
                    :to="{ name: 'user-page', params: { id: tweet.author.id } }"
                >
                    <img class="is-rounded" :src="tweet.author.avatar" alt="Author avatar">
                </router-link>

                <router-link v-else :to="{ name: 'user-page', params: { id: tweet.author.id } }">
                    <DefaultAvatar class="image is-64x64" :user="tweet.author" />
                </router-link>
            </figure>

            <div class="media-content">
                <div class="content">
                    <strong class="name">{{ tweet.author.name }}</strong>
                    <small class="nickname">@{{ tweet.author.nickname }}</small>
                    <small class="created">{{ tweet.created | createdDate }}</small>
                    <br>
                    {{ tweet.text }}
                    <figure
                        v-if="tweet.imageUrl"
                        class="image is-3by1 tweet-image"
                    >
                        <img :src="tweet.imageUrl" alt="Tweet image">
                    </figure>
                </div>

                <nav class="level is-mobile">
                    <div class="level-left">
                        <a class="level-item">
                            <span class="icon is-medium has-text-info">
                                <font-awesome-icon icon="comments" />
                            </span>
                            {{ tweet.commentsCount }}
                        </a>
                        <a class="level-item">
                            <span class="icon is-medium has-text-info">
                                <font-awesome-icon icon="heart" />
                            </span>
                            {{ tweet.likes_count || 0 }}
                        </a>
                    </div>
                </nav>
            </div>
        </article>
    </div>
</template>

<script>
import DefaultAvatar from './DefaultAvatar.vue';

export default {
    name: 'TweetPreview',

    components: {
        DefaultAvatar,
    },

    props: {
        tweet: {
            type: Object,
            required: true,
        },
    },
};
</script>

<style lang="scss" scoped>
@import '../../styles/common';

.tweet {
    cursor: pointer;
    padding: 15px;
    border-radius: 5px;
    box-shadow: 5px 5px 5px 0 #00000020;
    transition: 0.2s ease-out all;

    &:hover {
        box-shadow: 1px 1px 0 0 #00000020;
    }

    &-image {
        margin: 12px 0 0 0;

        img {
            width: auto;
        }
    }

    .nickname {
        margin-left: 5px;
    }

    .created {
        margin-left: 5px;
    }
}
</style>
