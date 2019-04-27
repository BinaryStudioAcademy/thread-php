<template>
    <div id="app">
        <Header />
        <transition name="fade">
            <router-view />
        </transition>
    </div>
</template>

<script>
import Header from '@/components/Header.vue';

export default {
    name: 'App',
    components: {
        Header,
    },
};
</script>

<style lang="scss">
@import '~buefy/dist/buefy.min.css';

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
}
</style>
