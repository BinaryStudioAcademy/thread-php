import { SET_LOADING } from '../../mutationTypes';
import api from '@/api/Api';
import { SET_AUTHENTICATED_USER } from '../auth/mutationTypes';

export default {
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

            commit(`auth/${SET_AUTHENTICATED_USER}`, data, { root: true });
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

            commit(`auth/${SET_AUTHENTICATED_USER}`, data, { root: true });
            commit(SET_LOADING, false, { root: true });

            return Promise.resolve();
        } catch (error) {
            commit(SET_LOADING, false, { root: true });

            return Promise.reject(error);
        }
    },
};
