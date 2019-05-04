<template>
    <div class="tweet box">
        <article class="media">
            <figure class="media-left">
                <p class="image is-64x64 is-square">
                    <img class="is-rounded" :src="tweet.author.avatar" alt="Author avatar">
                </p>
            </figure>

            <div class="media-content">
                <div class="content">
                    <strong class="name">{{ tweet.author.name }}</strong>
                    <small class="nickname">@{{ tweet.author.nickname }}</small>
                    <small class="created">{{ tweet.created | createdDate }}</small>
                    <br>
                    {{ tweet.text }}
                    <figure v-if="tweet.imageUrl" class="image is-3by1 tweet-image">
                        <img :src="tweet.imageUrl" alt="Tweet image">
                    </figure>
                </div>

                <nav class="level is-mobile">
                    <div class="level-left">
                        <a class="level-item">
                            <span class="icon is-medium"><font-awesome-icon icon="share" /></span>
                        </a>
                        <a class="level-item">
                            <span class="icon is-medium"><font-awesome-icon icon="comments" /></span>
                            {{ tweet.comments_count || 0 }}
                        </a>
                        <a class="level-item">
                            <span class="icon is-medium"><font-awesome-icon icon="heart" /></span>
                            {{ tweet.likes_count || 0 }}
                        </a>
                    </div>
                </nav>
            </div>
        </article>
    </div>
</template>

<script>
export default {
    name: 'Tweet',

    props: {
        tweet: {
            type: Object,
            required: true,
        },
    },
};
</script>

<style lang="scss" scoped>
.media + .media {
    padding-top: 10px;
}

.tweet {
    padding: 15px;
    border-radius: 5px;
    box-shadow: 5px 5px 5px 0 #00000020;

    .tweet-image {
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
