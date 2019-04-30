import axios from 'axios/index';
import Storage from '../services/Storage';

class Http {
    constructor(apiUrl, authHeaderName = 'Authorization', authHeaderPrefix = 'Bearer') {
        this.axios = axios.create({ baseURL: apiUrl });

        if (Storage.hasToken()) {
            this.axios.defaults.headers.common[authHeaderName] = `${authHeaderPrefix} ${Storage.getToken()}`;
        }

        this.axios
            .interceptors
            .response
            .use(
                response => response.data.data,
                error => Promise.reject(error.response.data.errors[0].message),
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
