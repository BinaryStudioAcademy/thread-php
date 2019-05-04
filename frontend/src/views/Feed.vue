<template>
    <div class="container">
        <TweetContainer />
    </div>
</template>

<script>
import TweetContainer from '@/components/TweetContainer.vue';

export default {
    name: 'FeedPage',

    components: {
        TweetContainer,
    },
};
</script>

<style lang="scss" scoped>
.container {
    max-width: 960px;
    padding-left: 10px;
    padding-right: 10px;
}
</style>
