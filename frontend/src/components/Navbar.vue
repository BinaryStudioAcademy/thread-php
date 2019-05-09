<template>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a
                role="button"
                class="navbar-burger burger"
                aria-label="menu"
                aria-expanded="false"
                data-target="header-navbar"
            >
                <span aria-hidden="true" />
                <span aria-hidden="true" />
                <span aria-hidden="true" />
            </a>
        </div>

        <div id="header-navbar" class="navbar-menu">
            <div class="navbar-start">
                <router-link class="navbar-item" to="/feed">
                    Feed
                </router-link>

                <router-link class="navbar-item" :to="{ name: 'user-page', params: { id: user.id }}">
                    My Feed
                </router-link>
            </div>

            <div class="navbar-end">
                <div class="navbar-item profile">
                    <figure class="image is-32x32 is-square">
                        <img
                            v-if="user.avatar"
                            class="profile-image is-rounded"
                            :src="user.avatar"
                        >
                        <DefaultAvatar v-else class="image is-32x32" :user="user" />
                    </figure>
                    <span class="profile-name">{{ user.name }}</span>
                    <span class="icon is-medium"><font-awesome-icon icon="angle-down" /></span>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import DefaultAvatar from './DefaultAvatar.vue';

export default {
    name: 'Navbar',

    components: {
        DefaultAvatar,
    },

    computed: {
        ...mapGetters('auth', {
            user: 'getAuthenticatedUser'
        }),
    },

    created() {
        this.fetchAuthenticatedUser()
            .catch(error => console.log(`Error occurred: ${error.message}`));
    },

    methods: {
        ...mapActions('auth', [
            'fetchAuthenticatedUser'
        ])
    }
};
</script>

<style lang="scss" scoped>
@import '../styles/common';

.navbar {
    margin-bottom: 20px;
    box-shadow: 5px 5px 5px 0 #00000020;
}

.navbar-item img {
    max-height: none;
}

.profile-name {
    margin-left: 10px;
}

.profile {
    .image.is-square {
        padding-top: 0;
    }
}
</style>
