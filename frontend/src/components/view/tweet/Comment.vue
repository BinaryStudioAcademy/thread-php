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
                    <strong>
                        {{ comment.author.firstName }} {{ comment.author.lastName }}
                    </strong>
                    <br>
                    {{ comment.body }}
                    <br>
                    <small>
                        {{ comment.created | createdDate }}
                    </small>
                </p>
                <nav class="level is-mobile">
                    <div class="level-left">
                        <a class="level-item">
                            <span class="icon is-medium has-text-info">
                                <font-awesome-icon icon="heart" />
                            </span>
                            {{ comment.likesCount }}
                        </a>
                    </div>
                </nav>
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
nav {
    margin-left: -8px;
}

.content {
    p {
        margin-bottom: 0;
    }
}
</style>
