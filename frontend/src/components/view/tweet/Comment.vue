<template>
    <article class="media">
        <figure class="media-left">
            <router-link
                class="image is-48x48 is-square"
                :to="{ name: 'user-page', params: { id: comment.author.id } }"
            >
                <img class="is-rounded" :src="comment.author.avatar">
            </router-link>
        </figure>
        <div class="media-content">
            <div class="content">
                <p>
                    <strong>{{ comment.author.name }}</strong>
                    <br>
                    {{ comment.body }}
                    <br>
                    <small>
                        <a>Like</a> ·
                        {{ comment.created | createdDate }}
                    </small>
                </p>
            </div>
        </div>
    </article>
</template>

<script>
export default {
    name: 'Comment',

    props: {
        comment: {
            type: Object,
            required: true,
        },
    },
};
</script>

<style lang="scss" scoped>

</style>
