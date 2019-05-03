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

                <div class="navbar-item">
                    <a class="button is-primary">
                        <strong>Add tweet</strong>
                    </a>
                </div>
            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    <figure class="image is-32x32">
                        <img
                            v-if="user.avatar"
                            class="profile-image is-rounded"
                            :src="user.avatar"
                        >
                        <strong v-else class="text-avatar">{{ nameLatters }}</strong>
                    </figure>
                    <span class="profile-name">{{ user.name }}</span>
                    <span class="icon is-medium"><font-awesome-icon icon="angle-down" /></span>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
    name: 'Navbar',

    computed: {
        ...mapGetters('auth', {
            user: 'getAuthenticatedUser'
        }),

        nameLatters() {
            return this.user.name && this.user.name.substr(0, 2).toUpperCase();
        }
    },
};
</script>

<style lang="scss" scoped>
.navbar {
    margin-bottom: 20px;
    box-shadow: 5px 5px 5px 0px #00000020;
}

.navbar-item img {
    max-height: none;
}

.profile-name {
    margin-left: 10px;
}

.text-avatar {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    border-radius: 50%;
    background: #cccccc;
}
</style>
