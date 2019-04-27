import Storage from '@/services/Storage';

export default {
    user: {
        id: null,
        firstName: '',
        lastName: '',
        avatar: '',
    },
    isLoggedIn: Storage.hasToken(),
    token: Storage.getToken(),
};
