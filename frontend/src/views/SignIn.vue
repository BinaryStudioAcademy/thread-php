<template>
    <section class="section is-large">
        <div class="container">
            <div class="columns is-mobile is-vcentered is-centered">
                <div class="column is-three-quarters-mobile is-two-thirds-tablet is-one-third-desktop">
                    <div class="box">
                        <p class="subtitle">
                            Don't have an account?
                            <router-link class="link link-signup" to="/auth/sign-up">
                                Sign up
                            </router-link>
                        </p>

                        <form
                            class="form"
                            @submit.prevent
                            novalidate="true"
                        >
                            <b-field label="Email">
                                <b-input
                                    v-model="user.email"
                                    name="email"
                                    autofocus
                                />
                            </b-field>

                            <b-field label="Password">
                                <b-input
                                    type="password"
                                    v-model="user.password"
                                    @keyup.native.enter="onLogin"
                                />
                            </b-field>

                            <div class="login-footer has-text-centered">
                                <button
                                    type="button"
                                    class="button is-primary is-rounded"
                                    @click="onLogin"
                                >
                                    Sign in
                                </button>
                            </div>
                        </form>
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
    name: 'SignInPage',

    mixins: [showStatusToast],

    data: () => ({
        user: {
            email: '',
            password: '',
        },
    }),

    methods: {
        ...mapActions('auth', [
            'signIn',
        ]),

        onLogin() {
            this.signIn(this.user)
                .then(() => {
                    this.showSuccessMessage('Welcome!');

                    this.$router.push({ path: '/' });
                })
                .catch(errorMessage => this.showErrorMessage(errorMessage));
        },
    },
};
</script>

<style scoped lang="scss">
    .box {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .subtitle {
        color: #8a94a6;
        font-size: 14px;
    }

    .link {
        color: #0e58cf;
        font-weight: 500;
    }
</style>
