<template>
    <div class="tweets-container">
        <Tweet :tweet="tweet" />
    </div>
</template>

<script>
import Tweet from '@/components/Tweet.vue';

export default {
    name: 'TweetContainer',

    components: {
        Tweet,
    },

    // get tweet

    data: () => ({
        tweet: {
            id: 1,
            text: 'Test tweet',
            created: '3h',
            author: {
                id: 1,
                name: 'Author 1',
                avatar: 'https://bulma.io/images/placeholders/96x96.png',
            },
        },
    }),
};
</script>

<style scoped lang="scss">

</style>
