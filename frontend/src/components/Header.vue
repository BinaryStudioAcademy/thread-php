<template>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <router-link class="navbar-item" to="/">
                <strong>Thread-PHP</strong>
            </router-link>

            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="header-navbar">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="header-navbar" class="navbar-menu">
            <div class="navbar-start">
                <router-link class="navbar-item" to="/feed">
                    Feed
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
                        <img v-if="currentUser.profile_image" class="profile-image is-rounded" :src="currentUser.profile_image">
                        <strong v-else class="text-avatar">{{ nameLatters }}</strong>
                    </figure>
                    <span class="profile-name">{{ currentUser.name }}</span>
                    <span class="icon is-medium"><font-awesome-icon icon="angle-down" /></span>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: 'Header',
    data() {
        return {
            currentUser: {
                name: 'Alex',
                nickname: 'aLLeXUs',
                profile_image: 'https://bulma.io/images/placeholders/128x128.png'
            }
        }
    },
    computed: {
        nameLatters: function () {
            return this.user.name.substr(0, 2).toUpperCase();
        }
    }
}
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