import axios from 'axios/index';
import Storage from '@/services/Storage';
import { EventEmitter, TOKEN_EXPIRED_EVENT } from '@/services/EventEmitter';
import { UNAUTHENTICATED } from '@/api/ErrorCodes';
import { getSocketId } from '@/services/Pusher';

class Api {
    constructor(apiUrl, authHeaderName = 'Authorization') {
        this.axios = axios.create({ baseURL: apiUrl });

        this.axios
            .interceptors
            .request
            .use(
                config => {
                    if (Storage.hasToken()) {
                        config.headers[authHeaderName] = `${Storage.getTokenType()} ${Storage.getToken()}`;
                    }

                    if (getSocketId()) {
                        config.headers['X-Socket-ID'] = getSocketId();
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
                errorResponse => {
                    const { response } = errorResponse;

                    if (!response) {
                        return Promise.reject(new Error('Unexpected error!'));
                    }

                    const error = response.data.errors[0];

                    if (error.code === UNAUTHENTICATED) {
                        EventEmitter.$emit(TOKEN_EXPIRED_EVENT, error);
                    }

                    return Promise.reject(error);
                },
            );
    }

    get(url, params) {
        return this.axios.get(url, { params });
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

export default new Api(process.env.VUE_APP_API_URL);
