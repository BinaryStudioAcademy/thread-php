<template>
    <article class="media">
        <figure class="media-left">
            <p class="image is-48x48 is-square">
                <img class="is-rounded" :src="comment.author.avatar">
            </p>
        </figure>
        <div class="media-content">
            <div class="content">
                <p>
                    <strong>
                        {{ comment.author.firstName }} {{ comment.author.lastName }}
                    </strong>
                    <br>
                    {{ comment.body }}
                    <br>
                    <small><a>Like</a> · <a>Reply</a> · {{ comment.created | createdDate }}</small>
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
