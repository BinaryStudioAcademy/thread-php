export default {
    hasToken: state => !!state.token,
    isLoggedIn: state => state.isLoggedIn,
    getAuthenticatedUser: state => state.user,
    getToken: state => state.token,
};
