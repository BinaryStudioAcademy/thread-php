<template>
    <EditProfileForm v-if="this.hasAuthenticatedUser" />
</template>

<script>
import { mapGetters } from 'vuex';
import EditProfileForm from '@/components/view/profile/EditProfileForm.vue';

export default {
    name: 'ProfilePage',

    components: {
        EditProfileForm,
    },

    computed: {
        ...mapGetters('auth', ['hasAuthenticatedUser']),
    },
};
</script>

<style scoped>

</style>
