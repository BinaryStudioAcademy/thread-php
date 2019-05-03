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
import { mapGetters, mapMutations } from 'vuex';
import { USER_LOGOUT } from './store/modules/auth/mutationTypes';
import { EventEmitter, TOKEN_EXPIRED_EVENT } from './services/EventEmitter';

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
        EventEmitter.$on(TOKEN_EXPIRED_EVENT, () => {
            this.logout();
            this.$router.push({ name: 'auth.signIn' });
        });
    },

    methods: {
        ...mapMutations('auth', {
            logout: USER_LOGOUT
        }),
    },
};
</script>

<style lang="scss">
@import '~buefy/dist/buefy.min.css';
@import 'styles/common';
</style>
