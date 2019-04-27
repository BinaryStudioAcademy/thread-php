class Storage {
    constructor() {
        this.keyName = 'auth.token';
        this.store = window.localStorage;
    }

    get(key) {
        return this.store.getItem(key);
    }

    set(key, value) {
        return this.store.setItem(key, value);
    }

    getToken() {
        return this.get(this.keyName);
    }

    setToken(token) {
        return this.set(this.keyName, token);
    }

    hasToken() {
        return !!this.get(this.keyName);
    }

    removeToken() {
        return this.store.removeItem(this.keyName);
    }
}

export default new Storage();
