export default {
    methods: {
        showErrorMessage(message) {
            this.$toast.open({
                message,
                type: 'is-danger',
            });
        },

        showSuccessMessage(message) {
            this.$toast.open({
                message,
                type: 'is-success',
            });
        },
    }
};
