<template>
    <p class="text-avatar">
        <strong>{{ nameLatters }}</strong>
    </p>
</template>

<script>
export default {
    name: 'DefaultAvatar',

    props: {
        user: {
            required: true,
            type: Object
        }
    },

    computed: {
        nameLatters() {
            return this.user.name && this.user.name.substr(0, 2).toUpperCase();
        }
    }
};
</script>

<style scoped>

</style>
