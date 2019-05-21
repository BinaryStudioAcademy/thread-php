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
* [Laracasts](https://laracasts.com)
* [Vue.js](https://www.youtube.com/playlist?list=PL5r0NkdgM0UOxb4Hl81FV5UIgexwTf8h7) tutorial
* [Vuex](https://www.youtube.com/playlist?list=PL4cUxeGkcC9i371QO_Rtkl26MwtiJ30P2) tutorial

## Tasks:

Task list is prioritized, more relevant are on top.

1. [`/tweets/:id` page] As a user I can edit own comment text and attach an image file;
2. [`/tweets/:id` page] As a user I can delete own commment;
3. [`/tweets/:id` page] As a user I can like any comment and see commen's likes count;
4. [`/feed` page] As a user I want to receive an email if anyone liked my post or comment;
5. [`/tweets/:id` page] As a user I can share a tweet in some social network by tweet's page unique URL;
6. [`/feed` page] As a user I want to sort tweets by created date(descending) or popularity(likes count) by click on some icon or button;
7. [`/tweets/:id` page] As a user I can see modal window which shows all users who liked a post by click on likes count;
8. [`/feed` page] As a user I can filter tweets and see only my favourite(was liked by me);
9. [`/tweets/:id` page] As a user I can paginate comments list using infinite scroll;
10. [`/tweets/:id` page] As a user I can see modal window which shows all users who liked a comment by click on likes count;
11. As a user I should be able to forgot and reset my password using an email;
12. [`/feed` page] As a user I want to see tweet's likes or comments count icon highlighted by some color if I liked or commented this tweet;
13. [`/tweets/:id` page] As a user I want see newly added comments in realtime similar to tweets;
14. [`/feed` page] As a user I want to switch between tweets layout view([cards](https://bulma.io/documentation/components/card/) or [media](https://bulma.io/documentation/layout/media-object/) objects);

You can use [Trello](https://trello.com) board to manage your tasks. Create lists like: Backlog, In Progress, Done. Put all tickets into Backlog first and move them into appropriate list depends on their status.

## Install

Installation is described inside backend and frontend folders independently.

## License

[MIT license](https://opensource.org/licenses/MIT).
