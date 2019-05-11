import Storage from '@/services/Storage';

export default {
    user: {
        id: null,
        email: '',
        firstName: '',
        lastName: '',
        nickname: '',
        avatar: '',
    },
    isLoggedIn: Storage.hasToken(),
    token: Storage.getToken(),
};
