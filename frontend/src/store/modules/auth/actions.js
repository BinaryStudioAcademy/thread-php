import { USER_LOGIN, SET_AUTHENTICATED_USER } from './mutationTypes';
import { SET_LOADING } from '../../mutationTypes';
import api from '@/api/Api';

export default {
    async signIn({ commit }, { email, password }) {
        commit(SET_LOADING, true, { root: true });

        try {
            const data = await api.post('/auth/login', {
                email,
                password,
            });

            commit(USER_LOGIN, data.access_token);
            commit(SET_LOADING, false, { root: true });

            return Promise.resolve();
        } catch (errorMsg) {
            commit(SET_LOADING, false, { root: true });

            return Promise.reject(errorMsg);
        }
    },

    async signUp({ commit }, {
        firstName,
        lastName,
        email,
        password,
        nickname
    }) {
        commit(SET_LOADING, true, { root: true });

        try {
            const data = await api.post('/auth/register', {
                first_name: firstName,
                last_name: lastName,
                email,
                password,
                nickname,
            });

            commit(USER_LOGIN, data.access_token);
            commit(SET_LOADING, false, { root: true });

            return Promise.resolve();
        } catch (error) {
            commit(SET_LOADING, false, { root: true });

            return Promise.reject(error);
        }
    },

    async fetchAuthenticatedUser({ commit }) {
        commit(SET_LOADING, true, { root: true });

        try {
            const data = await api.get('/auth/me');

            commit(SET_AUTHENTICATED_USER, data);
            commit(SET_LOADING, false, { root: true });

            return Promise.resolve();
        } catch (error) {
            commit(SET_LOADING, false, { root: true });

            return Promise.reject(error);
        }
    },
};
