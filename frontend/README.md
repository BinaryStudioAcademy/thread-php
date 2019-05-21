# BSA 2019 Thread project (frontend)

## Technologies

* [Vue.js](https://vuejs.org/) framework
* [vue-cli](https://cli.vuejs.org/)
* [vue-router](https://router.vuejs.org/)
* [vuex](https://vuex.vuejs.org/)
* [Buefy](https://buefy.org/) UI framework
* [pusher-js](https://github.com/pusher/pusher-js)

## Getting started

Install the following packages prior to standing up your development environment:

- [node](https://nodejs.org/en/)
- [yarn](https://yarnpkg.com/en/docs/install)

Prepare environment:
```
cp .env.example .env.local
yarn install
```

Configure your `.env.local`:
```
VUE_APP_API_URL=http://<host>:<port>/api/v1
VUE_APP_PUSHER_APP_KEY=<pusher-app-key>
VUE_APP_PUSHER_APP_CLUSTER=<pusher-app-cluster>
VUE_APP_PUSHER_APP_AUTH_ENDPOINT=http://<host>:<port>/broadcasting/auth
```

Replace `<host>` and `<port>` according to your backend URL. You should register an account and create an application on [Pusher](https://pusher.com/) site to get `<pusher-app-key>` and `<pusher-app-cluster>` variables. These credentials also should be used on the backend.

After that application is ready. You can run it in development mode with `yarn run serve` or `yarn run build` to generate compiled and minified files.
