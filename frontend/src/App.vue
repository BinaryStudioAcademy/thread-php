<template>
    <div id="app">
        <Navbar v-if="isLoggedIn" />
        <transition name="fade">
            <router-view />
        </transition>
        <b-loading
            :is-full-page="true"
            :active.sync="isLoading"
            :can-cancel="false"
        />
    </div>
</template>

<script>
import Navbar from '@/components/Navbar.vue';
import { mapActions, mapGetters, mapMutations } from 'vuex';
import { USER_LOGOUT } from './store/modules/auth/mutationTypes';
import { UNAUTHENTICATED } from '@/api/ErrorCodes';

export default {
    name: 'App',

    components: {
        Navbar,
    },

    computed: {
        ...mapGetters([
            'isLoading'
        ]),
        ...mapGetters('auth', [
            'isLoggedIn',
        ]),
    },

    created() {
        this.fetchAuthenticatedUser()
            .catch(error => {
                if (error.code === UNAUTHENTICATED) {
                    this.logout();
                    this.$router.push({ name: 'auth.signIn' });
                }
            });
    },

    methods: {
        ...mapActions('auth', [
            'fetchAuthenticatedUser'
        ]),

        ...mapMutations('auth', {
            logout: USER_LOGOUT
        }),
    },
};
</script>

<style lang="scss">
@import '~buefy/dist/buefy.min.css';
@import 'styles/common';

html, body {
    padding: 0;
    margin: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

#app {
    font-family: 'Avenir', Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    color: $font-color;
    background-color: $background-color;
    width: 100%;
    height: 100%;
}
</style>
