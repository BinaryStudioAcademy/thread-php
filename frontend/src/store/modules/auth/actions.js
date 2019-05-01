import { USER_LOGIN } from './mutationTypes';
import { SET_LOADING } from '../../mutationTypes';
import Http from '@/api/Http';

export default {
    async signIn({ commit }, { email, password }) {
        commit(SET_LOADING, true, { root: true });

        try {
            const data = await Http.post('/auth/login', {
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
};
