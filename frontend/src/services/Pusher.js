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

export const updateSocketAuthToken = (token) => {
    config.auth.headers = {
        Authorization: `Bearer ${token}`
    };
};

if (Storage.hasToken()) {
    updateSocketAuthToken(Storage.getToken());
}


export const pusher = new Pusher(process.env.VUE_APP_PUSHER_APP_KEY, config);
