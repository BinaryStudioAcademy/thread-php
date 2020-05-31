# BSA Mini-Project - Thread (backend)

## Technologies

* PHP 7.3
* [Laravel 6](https://laravel.com)
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

### Launch local environment

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

Application server should be ready on `http://localhost:<APP_PORT>`

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

You can debug your app with [Telescope](https://laravel.com/docs/6.x/telescope) tool which is installed already :)

## FAQ

* `Illuminate\Database\QueryException  : SQLSTATE[HY000] [2002] Connection refused`
    * The application can not connect to the database. Probably, `DB_HOST` environment variable is not set correctly. If you are using `docker-compose` configuration, the database host will match the database container name from `docker-compose.yml` (`mysql` in this case).
* `SQLSTATE[HY000] [1045] Access denied for user 'XXXX'@'thread-app.backend_default' (using password: YES)`
    * The application can not connect to the database due to incorrect username and password. Most likely, `DB_USERNAME` or/and `DB_PASSWORD` environment variables are set incorrectly. If you are using `docker-compose` configuration, the database username and password will match the initial values `MYSQL_USER` and `MYSQL_PASSWORD` of `docker-compose.yml` (`user` and `secret` in this case). Keep in mind that these credentials are set on the first time database container running, and changing these values will not take effect unless the database data folder will be deleted and the database container will be recreated.
* `Composer could not find a composer.json file in /var/www/app. To initialize a project, please create a composer.json file as described in the https://getcomposer.org/ "Getting Started" section`
    * Most likely you are on Windows and shared folders are not configured correctly. Please, follow the instructions from [this article](https://rominirani.com/docker-on-windows-mounting-host-directories-d96f3f056a2c) in case you have `Docker for Windows`, or [this article](https://github.com/docker/toolbox/issues/796#issuecomment-582267767) in case you have `Docker Toolbox`. The easiest way is to put the project folder to the `C:\Users\` folder as it is shared by default.
* `Access to XMLHttpRequest at 'http://XX.XX.XX.XX:7777/api/v1/auth/register' from origin 'http://127.0.0.1:8080' has been blocked by CORS policy: Response to preflight request doesn't pass access control check: No 'Access-Control-Allow-Origin' header is present on the requested resource.`
    * Most commonly, a critical error occurred on the backend, and CORS headers were not set, so the browser will not allow this request. You can send the same request via external tools (like [Postman](https://www.postman.com/)), and you will be able to see the error in the response there. In most cases, this error occurs when a database connection can not be established AND the framework can not write to the log file.
* `ERROR: for thread-webserver  Cannot start service webserver: OCI runtime create failed: container_linux.go:346:`
    * Probably, you have not configured shared folders for `Docker`. It is described in one of the previous answers.
