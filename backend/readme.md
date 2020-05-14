# BSA 2019 Thread (backend)

## Technologies

* PHP 7.3
* [Laravel 5.8](https://laravel.com)
* [Docker](https://www.docker.com/)
* [Docker-compose](https://docs.docker.com/compose/)
* [Beanstalkd](https://github.com/beanstalkd/beanstalkd) - message queue (очередь сообщений для обработки тяжелых задач асинхронно)
* [REST API](https://ru.wikipedia.org/wiki/REST)
* [CORS](https://developer.mozilla.org/ru/docs/Web/HTTP/CORS)
* [JWT](https://ru.wikipedia.org/wiki/JSON_Web_Token) tokens
* Websockets and [Pusher](https://pusher.com/) service
* MySQL 5.7

## Install

Set your .env vars:
```bash
cp .env.example .env
```

### Launch local environment:

Step inside project directory
```bash
cd <project_dir>/backend
```

Start application docker containers:
``` bash
docker-compose up -d
```

Install composer dependencies and generate app key:
```bash
docker exec -it thread-app composer install
docker exec -it thread-app php artisan key:generate
```

Database migrations install (set proper .env vars)
```bash
docker exec -it thread-app php artisan migrate
docker exec -it thread-app php artisan db:seed
```

Generate jwt key and create link to public folder for file uploads (you should have `FILESYSTEM_DRIVER=public` in .env):
```bash
docker exec -it thread-app php artisan jwt:secret
docker exec -it thread-app php artisan storage:link
```

Application server should be ready on http://localhost:<APP_PORT>

Pusher websocket server install:
* Create an account and application on [pusher.com](https://pusher.com/) and copy your credentials to your .env (`PUSHER_APP_ID=...`).
* Update your .env (`QUEUE_CONNECTION=beanstalkd`, `BROADCAST_DRIVER=pusher`) and launch beanstalkd queue listening to messages by `docker exec -it thread-app php artisan queue:work`

Emails processing .env settings (you can use [mailtrap](https://mailtrap.io/) or your smtp credentials like user@gmail.com):
```dotenv
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_USERNAME=<mailtrap_key>
MAIL_PASSWORD=<mailtrap_password>
MAIL_PORT=587
MAIL_FROM_ADDRESS=admin@thread.com
MAIL_FROM_NAME="BSA Thread Admin"
```

You can debug your app with [Telescope](https://laravel.com/docs/5.8/telescope) tool which is installed already :)
