<template>
    <div class="container desktop">
        <FeedContainer />
    </div>
</template>

<script>
import FeedContainer from '@/components/view/feed/FeedContainer.vue';

export default {
    name: 'FeedPage',

    components: {
        FeedContainer,
    },
};
</script>

<style lang="scss" scoped>
</style>
