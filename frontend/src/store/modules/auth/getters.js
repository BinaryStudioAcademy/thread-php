export default {
    hasToken: state => !!state.token,
    isLoggedIn: state => state.isLoggedIn,
    hasAuthenticatedUser: state => !!state.user.id,
    getAuthenticatedUser: state => state.user,
    getToken: state => state.token,
    getFullName: state => `${state.user.firstName} ${state.user.lastName}`,
};
