import axios from 'axios/index';
import Storage from '../services/Storage';
import { UNAUTHENTICATED } from './ErrorCodes';

class Http {
    constructor(apiUrl, authHeaderName = 'Authorization', authHeaderPrefix = 'Bearer') {
        this.axios = axios.create({ baseURL: apiUrl });

        this.axios
            .interceptors
            .request
            .use(
                config => {
                    if (Storage.hasToken()) {
                        config.headers[authHeaderName] = `${authHeaderPrefix} ${Storage.getToken()}`;
                    }

                    return config;
                },
                error => Promise.reject(error)
            );

        this.axios
            .interceptors
            .response
            .use(
                response => response.data.data,
                error => {
                    if (error.response.data.errors[0].code === UNAUTHENTICATED) {
                        Storage.removeToken();
                    }

                    return Promise.reject(error.response.data.errors[0].message);
                },
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

export default new Http(process.env.VUE_APP_API_URL);
