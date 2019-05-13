<template>
    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-mobile is-centered">
                    <div class="column is-three-quarters-mobile is-two-thirds-tablet is-one-third-desktop">
                        <div class="box shadow-box">
                            <p class="subtitle">
                                Already have an account?
                                <router-link class="link link-signup" to="/auth/sign-in">
                                    Sign in
                                </router-link>
                            </p>

                            <form
                                class="form"
                                @submit.prevent
                                novalidate="true"
                            >
                                <b-field label="First Name">
                                    <b-input
                                        v-model="user.firstName"
                                        name="first_name"
                                        autofocus
                                    />
                                </b-field>

                                <b-field label="Last Name">
                                    <b-input
                                        v-model="user.lastName"
                                        name="last_name"
                                    />
                                </b-field>

                                <b-field label="Email">
                                    <b-input
                                        v-model="user.email"
                                        name="email"
                                    />
                                </b-field>

                                <b-field label="Password">
                                    <b-input
                                        type="password"
                                        v-model="user.password"
                                    />
                                </b-field>

                                <b-field label="Nickname">
                                    <b-input
                                        v-model="user.nickname"
                                        name="nickname"
                                        @keyup.native.enter="onSubmit"
                                    />
                                </b-field>

                                <div class="login-footer has-text-centered">
                                    <button
                                        type="button"
                                        class="button is-primary is-rounded"
                                        @click="onSubmit"
                                    >
                                        Sign up
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { mapActions } from 'vuex';
import showStatusToast from '../components/mixin/showStatusToast';

export default {
    name: 'SignUpPage',

    mixins: [showStatusToast],

    data: () => ({
        user: {
            firstName: '',
            lastName: '',
            email: '',
            password: '',
            nickname: ''
        }
    }),

    methods: {
        ...mapActions('auth', [
            'signUp',
        ]),

        onSubmit() {
            this.signUp(this.user)
                .then(() => {
                    this.showSuccessMessage('Welcome!');

                    this.$router.push({ path: '/' });
                })
                .catch(error => this.showErrorMessage(error.message));
        },
    },
};

</script>

<style scoped>
</style>
