import { USER_LOGIN, USER_LOGOUT, SET_AUTHENTICATED_USER } from './actionTypes';
import Storage from '@/services/Storage';

export default {
    [USER_LOGIN]: (state, response) => {
        Storage.setToken(response.access_token);

        state.token = response.access_token;
        state.isLoggedIn = true;
    },

    [USER_LOGOUT]: state => {
        Storage.removeToken();

        state.token = '';
        state.isLoggedIn = false;
        state.user = {
            id: null,
            firstName: '',
            lastName: '',
            avatar: '',
        };
    },

    [SET_AUTHENTICATED_USER]: (state, user) => {
        state.isLoggedIn = true;
        state.currentUser = user;
    },
};
