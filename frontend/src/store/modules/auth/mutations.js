import { USER_LOGIN, USER_LOGOUT, SET_AUTHENTICATED_USER } from './mutationTypes';
import Storage from '@/services/Storage';
import { userMapper } from '../../../services/Normalizer';

export default {
    [USER_LOGIN]: (state, accessToken) => {
        Storage.setToken(accessToken);

        state.token = accessToken;
        state.isLoggedIn = true;
    },

    [USER_LOGOUT]: state => {
        Storage.removeToken();

        state.token = '';
        state.isLoggedIn = false;
        state.user = {
            id: null,
            email: '',
            firstName: '',
            lastName: '',
            nickname: '',
            avatar: '',
        };
    },

    [SET_AUTHENTICATED_USER]: (state, user) => {
        state.isLoggedIn = true;
        state.user = userMapper(user);
    },
};
