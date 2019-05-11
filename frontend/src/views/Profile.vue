<template>
    <div class="profile container desktop box">
        <div class="tile is-ancestor">
            <div class="tile is-parent">
                <div class="tile is-child avatar">
                    <p v-if="user.avatar" class="image is-square">
                        <img class="is-rounded" :src="user.avatar">
                    </p>
                    <DefaultAvatar v-else class="image" :user="user" />
                </div>
            </div>
            <div class="tile is-parent is-8">
                <div class="tile is-child">
                    <b-field label="First Name">
                        <b-input v-model="user.firstName"></b-input>
                    </b-field>
                    <b-field label="Last Name">
                        <b-input v-model="user.lastName"></b-input>
                    </b-field>
                    <b-field label="Nickname">
                        <b-input v-model="user.nickname"></b-input>
                    </b-field>
                    <b-field label="Email">
                        <b-input v-model="user.email" type="email"></b-input>
                    </b-field>
                    <b-button type="is-primary">Save</b-button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
    name: 'ProfilePage',

    computed: {
        ...mapGetters('auth', {
            user: 'getAuthenticatedUser'
        }),
    },
};
</script>

<style scoped>
.profile.container {
    padding: 20px;
}

.avatar {
    padding: 10px;
}
</style>
