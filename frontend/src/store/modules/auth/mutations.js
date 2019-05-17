import { USER_LOGIN, USER_LOGOUT, SET_AUTHENTICATED_USER } from './mutationTypes';
import Storage from '@/services/Storage';
import { emptyUser, userMapper } from '@/services/Normalizer';
import { updateSocketAuthToken, removeSocketAuthToken } from '@/services/Pusher';

export default {
    [USER_LOGIN]: (state, accessToken) => {
        Storage.setToken(accessToken);
        updateSocketAuthToken(accessToken);

        state.token = accessToken;
        state.isLoggedIn = true;
    },

    [USER_LOGOUT]: state => {
        Storage.removeToken();
        removeSocketAuthToken();

        state.token = '';
        state.isLoggedIn = false;
        state.user = emptyUser();
    },

    [SET_AUTHENTICATED_USER]: (state, user) => {
        state.isLoggedIn = true;
        state.user = userMapper(user);
    },
};
