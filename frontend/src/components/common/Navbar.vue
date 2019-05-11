<template>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a
                role="button"
                class="navbar-burger burger"
                :class="{ 'is-active': isMobileMenuActive }"
                aria-label="menu"
                aria-expanded="false"
                @click="toggleMobileMenu"
            >
                <span aria-hidden="true" />
                <span aria-hidden="true" />
                <span aria-hidden="true" />
            </a>
        </div>

        <div class="navbar-menu is-hidden-desktop mobile-menu" :class="{ 'is-active': isMobileMenuActive }">
            <router-link class="navbar-item" :to="{ name: 'feed' }">
                <b-icon pack="fab" icon="twitter" />
                <span>Feed</span>
            </router-link>

            <router-link class="navbar-item" :to="{ name: 'user-page', params: { id: user.id }}">
                <b-icon pack="fab" icon="twitter-square" />
                <span>My feed</span>
            </router-link>

            <hr class="navbar-divider">

            <router-link class="navbar-item" :to="{ name: 'profile' }">
                <b-icon pack="fa" icon="cog" />
                <span>Settings</span>
            </router-link>


            <a class="navbar-item" @click="onSignOut">
                <b-icon pack="fa" icon="sign-out-alt" />
                <span>Exit</span>
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
                <div class="navbar-item has-dropdown is-hoverable profile">
                    <a class="navbar-link">
                        <figure class="image is-32x32 is-square">
                            <img
                                v-if="user.avatar"
                                class="profile-image is-rounded"
                                :src="user.avatar"
                            >
                            <DefaultAvatar v-else class="image is-32x32" :user="user" />
                        </figure>
                        <span class="profile-name">{{ user.name }}</span>
                    </a>

                    <div class="navbar-dropdown is-right">
                        <router-link class="navbar-item" :to="{ name: 'profile' }">
                            <b-icon pack="fa" icon="cog" />
                            <span>Settings</span>
                        </router-link>

                        <hr class="navbar-divider">

                        <a class="navbar-item" @click="onSignOut">
                            <b-icon pack="fa" icon="sign-out-alt" />
                            <span>Exit</span>
                        </a>
                    </div>
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

    data: () => ({
        isMobileMenuActive: false
    }),

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
            'fetchAuthenticatedUser',
            'signOut'
        ]),

        async onSignOut() {
            await this.signOut();

            this.$router.push({ name: 'auth.signIn' });
        },

        toggleMobileMenu() {
            this.isMobileMenuActive = !this.isMobileMenuActive;
        }
    }
};
</script>

<style lang="scss" scoped>
@import '../../styles/common';

.navbar {
    margin-bottom: 30px;
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

.mobile-menu {
    .navbar-item {
        display: flex;
        align-items: center;

        .icon {
            margin-right: 10px;
        }

        span:last-child {
            line-height: 1.588;
        }
    }
}
</style>
