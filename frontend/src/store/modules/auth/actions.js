import { USER_LOGIN, SET_AUTHENTICATED_USER, USER_LOGOUT } from './mutationTypes';
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
            const user = await api.get('/auth/me');

            commit(SET_AUTHENTICATED_USER, user);
            commit(SET_LOADING, false, { root: true });

            return Promise.resolve();
        } catch (error) {
            commit(SET_LOADING, false, { root: true });

            return Promise.reject(error);
        }
    },

    async signOut({ commit }) {
        commit(SET_LOADING, true, { root: true });

        try {
            await api.post('/auth/logout');

            commit(USER_LOGOUT);
            commit(SET_LOADING, false, { root: true });

            return Promise.resolve();
        } catch (error) {
            commit(SET_LOADING, false, { root: true });

            return Promise.reject(error);
        }
    },

    async updateProfile({ commit }, {
        email,
        firstName,
        lastName,
        nickname
    }) {
        commit(SET_LOADING, true, { root: true });

        try {
            const data = await api.put('/auth/me', {
                email,
                first_name: firstName,
                last_name: lastName,
                nickname
            });

            commit(SET_AUTHENTICATED_USER, data,);
            commit(SET_LOADING, false, { root: true });

            return Promise.resolve();
        } catch (error) {
            commit(SET_LOADING, false, { root: true });

            return Promise.reject(error);
        }
    },

    async updateProfileImage({ commit }, image) {
        commit(SET_LOADING, true, { root: true });

        try {
            const formData = new FormData();
            formData.append('image', image, image.name);

            const data = await api.post('/auth/me/image', formData);

            commit(SET_AUTHENTICATED_USER, data,);
            commit(SET_LOADING, false, { root: true });

            return Promise.resolve();
        } catch (error) {
            commit(SET_LOADING, false, { root: true });

            return Promise.reject(error);
        }
    },
};
