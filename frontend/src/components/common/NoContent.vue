<template>
    <section class="hero is-info" v-show="show">
        <div class="hero-body">
            <div class="has-text-centered">
                <p class="title">
                    {{ title }}
                </p>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: 'NoContent',

    props: {
        title: {
            default: 'No content :)',
            type: String
        },

        show: {
            type: Boolean,
            required: true
        }
    }
};
</script>

<style scoped>

</style>
