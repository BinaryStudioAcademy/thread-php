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
            return this.user.firstName.substr(0, 1).toUpperCase()
                + this.user.lastName.substr(0, 1).toUpperCase();
        }
    }
};
</script>

<style scoped>

</style>
