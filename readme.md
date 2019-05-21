# BSA 2019 Thread

[![Build Status](https://travis-ci.org/BinaryStudioAcademy/thread-php.svg?branch=dev)](https://travis-ci.org/BinaryStudioAcademy/thread-php)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/d1280e7b47b9492abd59cf0081a95cdb)](https://app.codacy.com/app/pavelnemoi/thread-php?utm_source=github.com&utm_medium=referral&utm_content=BinaryStudioAcademy/thread-php&utm_campaign=Badge_Grade_Settings)
[![StyleCI](https://github.styleci.io/repos/178824653/shield)](https://styleci.io/repos/178824653)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

## Description

This is a learning goal [SPA](https://en.wikipedia.org/wiki/Single-page_application) mini-project which is much like real Twitter, but even better of course :)

Core features:

* Registration
* Add tweets(or posts)
* Add tweet's comments
* Edit user's profile data

*Main idea for this stage is to get better understanding of application backend/frontend codebase,
what design patterns was used and how to solve some widespread data processing tasks.
There is no need to deeply learn all tech stack that was used to built this app, 
but just get an idea of modern SPA web application architecture and tools that can help to built it.*  

## Technologies

Backend:

* PHP 7.2 || 7.3
* [Laravel 5.8](https://laravel.com)
* [Docker](https://www.docker.com/)
* [Docker-compose](https://docs.docker.com/compose/)
* [Beanstalkd](https://github.com/beanstalkd/beanstalkd) - message queue (очередь сообщений для обработки тяжелых задач асинхронно)
* [REST API](https://ru.wikipedia.org/wiki/REST)
* [CORS](https://developer.mozilla.org/ru/docs/Web/HTTP/CORS)
* [JWT](https://ru.wikipedia.org/wiki/JSON_Web_Token) tokens
* Websockets and [Pusher](https://pusher.com/) service

Frontend:

* [Vue.js](https://vuejs.org/) framework
* [vue-cli](https://cli.vuejs.org/)
* [vue-router](https://router.vuejs.org/)
* [vuex](https://vuex.vuejs.org/)
* [Buefy](https://buefy.org/) UI framework
* [pusher-js](https://github.com/pusher/pusher-js)

Additional software which might be helpful

* [Postman](https://www.getpostman.com/) (debug your backend api endpoints)
* [Vue devtools](https://github.com/vuejs/vue-devtools) (debug your frontend components state)
* [MySQL Workbench](https://www.mysql.com/products/workbench/) (database management tool)
* [PHPStorm](https://www.jetbrains.com/phpstorm/) || [VSCode](https://code.visualstudio.com/)

Github repository [https://github.com/BinaryStudioAcademy/thread-php](https://github.com/BinaryStudioAcademy/thread-php)

Application link [https://bsa-thread.now.sh](https://bsa-thread.now.sh).

Helpful articles or materials:

* [Dependency Injection](https://designpatternsphp.readthedocs.io/en/latest/Structural/DependencyInjection/README.html)
* [Repository pattern](https://designpatternsphp.readthedocs.io/en/latest/More/Repository/README.html) (*Repository\UserRepository.php*)
* [Command pattern](https://designpatternsphp.readthedocs.io/en/latest/Behavioral/Command/README.html) (*Action\AddTweetAction.php*)
* [DTO pattern](https://dzone.com/articles/how-to-manage-traffic-and-preserve-rankings-when-y) (*Action\AddTweetRequest.php*)

## Tasks:


## Install

Installation is described inside backend and frontend folders independently.

## License

[MIT license](https://opensource.org/licenses/MIT).
