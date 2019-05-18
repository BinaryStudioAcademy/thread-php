import Pusher from 'pusher-js';
import Storage from '@/services/Storage';

const config = {
    authEndpoint: process.env.VUE_APP_PUSHER_APP_AUTH_ENDPOINT,
    cluster: process.env.VUE_APP_PUSHER_APP_CLUSTER,
    forceTLS: true,
    auth: {
        headers: {}
    }
};

if (Storage.hasToken()) {
    config.auth.headers = {
        Authorization: `${Storage.getTokenType()} ${Storage.getToken()}`
    };
}

export const pusher = new Pusher(process.env.VUE_APP_PUSHER_APP_KEY, config);

export const getSocketId = () => pusher.connection.socket_id;

export const updateSocketAuthToken = (tokenType, accessToken) => {
    pusher.config.auth.headers.Authorization = `${tokenType} ${accessToken}`;
};

export const removeSocketAuthToken = () => {
    pusher.config.auth.headers = {};
};
