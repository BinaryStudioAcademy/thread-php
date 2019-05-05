<template>
    <div class="container">
        <FeedContainer />
    </div>
</template>

<script>
import FeedContainer from '@/components/FeedContainer.vue';

export default {
    name: 'FeedPage',

    components: {
        FeedContainer,
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
