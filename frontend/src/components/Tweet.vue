<template>
    <article class="tweet media">
        <figure class="media-left">
            <p class="image is-64x64">
                <img :src="tweet.author.avatar_image">
            </p>
        </figure>
        <div class="media-content">
            <div class="content">
                <strong class="name">{{ tweet.author.name }}</strong>
                <small class="nickname">@{{ tweet.author.nickname }}</small>
                <small class="created">31m</small>
                <br />
                {{ tweet.text }}
                <figure v-if="tweet.image_url" class="image is-square">
                    <img :src="tweet.image_url" />
                </figure>
            </div>
            <nav class="level is-mobile">
                <div class="level-left">
                    <a class="level-item">
                        <span class="icon is-medium"><font-awesome-icon icon="share" /></span>
                    </a>
                    <a class="level-item">
                        <span class="icon is-medium"><font-awesome-icon icon="comments" /></span>
                        {{ tweet.comments_count }}
                    </a>
                    <a class="level-item">
                        <span class="icon is-medium"><font-awesome-icon icon="heart" /></span>
                        {{ tweet.likes_count }}
                    </a>
                </div>
            </nav>
        </div>
    </article>
</template>

<script>
export default {
    name: 'Tweet',
    props: {
        tweet: {
            type: Object,
            required: true
        }
    }
}
</script>

<style lang="scss" scoped>
.media + .media {
    padding-top: 10px;
}

.tweet {
    background: #ffffff;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 5px 5px 5px 0px #00000020;

    .content .image {
        margin: 10px 20px 0 0;

        img {
            border-radius: 5px;
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
