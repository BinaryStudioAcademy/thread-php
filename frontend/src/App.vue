<template>
    <div id="app">
        <Header v-if="isLoggedIn" />
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
import Header from '@/components/Header.vue';
import { mapGetters } from 'vuex';

export default {
    name: 'App',

    components: {
        Header,
    },

    computed: {
        ...mapGetters([
            'isLoading'
        ]),
        ...mapGetters('auth', [
            'isLoggedIn',
        ]),
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
