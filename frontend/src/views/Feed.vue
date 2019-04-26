<template>
    <div class="container">
        <template v-for="(tweet, index) in tweets">
            <Tweet
                :key="index"
                :tweet="tweet"
            />
        </template>
    </div>
</template>

<script>
import Tweet from '@/components/Tweet';

export default {
    components: {
        Tweet
    },
    data() {
        return {
            tweets: [
                {
                    id: 1,
                    text: 'Test tweet',
                    image_url: 'https://media.sproutsocial.com/uploads/2017/02/10x-featured-social-media-image-size.png',
                    author: {
                        id: 1,
                        name: 'Alex',
                        nickname: 'alex',
                        avatar_image: 'https://bulma.io/images/placeholders/128x128.png'
                    },
                    likes_count: 5,
                    comments_count: 2
                },
                {
                    id: 2,
                    text: 'Test tweet 2',
                    author: {
                        id: 2,
                        name: 'John',
                        nickname: 'john',
                        avatar_image: 'https://bulma.io/images/placeholders/128x128.png'
                    },
                    likes_count: 15,
                    comments_count: 7
                },
            ]
        };
    },
};
</script>

<style lang="scss" scoped>
.container {
    max-width: 600px;
    padding-left: 10px;
    padding-right: 10px;
}
</style>
