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
            return `${this.user.firstName[0].toUpperCase()}${this.user.lastName[0].toUpperCase()}`;
        }
    }
};
</script>

<style scoped>

</style>
