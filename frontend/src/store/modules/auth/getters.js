import Storage from '@/services/Storage';

export default {
    hasToken: () => Storage.hasToken(),
    isLoggedIn: state => state.isLoggedIn,
    getAuthenticatedUser: state => state.currentUser,
    getToken: () => Storage.getToken(),
};
