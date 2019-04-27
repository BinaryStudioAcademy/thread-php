import axios from 'axios';
import Storage from './Storage';

class Http {
    constructor() {
        this.prefix = '/api/v1';
        this.axios = axios.create({
            baseURL: this.prefix,
        });

        this.axios
            .interceptors
            .request
            .use(
                (config) => {
                    if (Storage.hasToken()) {
                        config.headers['Authorization'] = `Bearer${Storage.getToken()}`;
                    }

                    return Promise.resolve(config);
                },
                error => Promise.reject(error),
            );
    }

    get(url, params) {
        return this.axios.get(url, params);
    }

    post(url, data) {
        return this.axios.post(url, data);
    }

    put(url, data) {
        return this.axios.put(url, data);
    }

    delete(url, params) {
        return this.axios.delete(url, params);
    }
}

export default new Http();
