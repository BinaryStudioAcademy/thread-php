# BSA 2019 Thread

## Описание

Этот мини-проект является [SPA](https://en.wikipedia.org/wiki/Single-page_application), который немного похож на Twitter :)

Возможности:

* Регистрация
* Создание твита(или поста)
* Комментрование твита
* Обновление профиля пользователя

*Основная идея этой стадии в том, чтобы получить понимание архитектуры приложения, организации и написания 
backend/frontend кода, использования дизайн паттернов и понимания алгоритма обработки данных.
Нет необходимости в том, чтобы глубоко изучить каждую технологию, использованную в проекте, но важно получить
общее понимание построения современного SPA веб-приложения и инструментов, которые могут в этом помочь.*

## Технологии

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
* MySQL 5.7

Frontend:

* [Vue.js](https://vuejs.org/) framework
* [vue-cli](https://cli.vuejs.org/)
* [vue-router](https://router.vuejs.org/)
* [vuex](https://vuex.vuejs.org/)
* [Buefy](https://buefy.org/) UI framework
* [pusher-js](https://github.com/pusher/pusher-js)

## Дополнительные утилиты, которые могут быть полезны:

* [Postman](https://www.getpostman.com/) (debug your backend api endpoints)
* [Vue devtools](https://github.com/vuejs/vue-devtools) (debug your frontend components state)
* [MySQL Workbench](https://www.mysql.com/products/workbench/) (database management tool)
* [PHPStorm](https://www.jetbrains.com/phpstorm/) || [VSCode](https://code.visualstudio.com/)

Github репозиторий [https://github.com/BinaryStudioAcademy/thread-php](https://github.com/BinaryStudioAcademy/thread-php)

Адресс приложения [https://bsa-thread.now.sh](https://bsa-thread.now.sh).

## Вспомогательные материалы:

* [Dependency Injection](https://designpatternsphp.readthedocs.io/en/latest/Structural/DependencyInjection/README.html)
* [Repository pattern](https://designpatternsphp.readthedocs.io/en/latest/More/Repository/README.html) (*Repository\UserRepository.php*)
* [Command pattern](https://designpatternsphp.readthedocs.io/en/latest/Behavioral/Command/README.html) (*Action\AddTweetAction.php*)
* [DTO pattern](https://dzone.com/articles/how-to-manage-traffic-and-preserve-rankings-when-y) (*Action\AddTweetRequest.php*)
* [Laracasts](https://laracasts.com)
* [Vue.js](https://www.youtube.com/playlist?list=PL5r0NkdgM0UOxb4Hl81FV5UIgexwTf8h7) tutorial
* [Vuex](https://www.youtube.com/playlist?list=PL4cUxeGkcC9i371QO_Rtkl26MwtiJ30P2) tutorial

## Список задач, отсортирован по релевантности

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
11. As a user I should be able to reset my password using an email (forgot password feature);
12. [`/feed` page] As a user I want to see tweet's likes or comments count icon highlighted by some color if I liked or commented this tweet;
13. [`/tweets/:id` page] As a user I want see newly added comments in realtime similar to tweets;
14. [`/feed` page] As a user I want to switch between tweets layout view([cards](https://bulma.io/documentation/components/card/) or [media](https://bulma.io/documentation/layout/media-object/) objects);

Для удобства вам предлагается создать [Trello](https://trello.com) доску для организации процесса выполнения задач. Создайте списки: Backlog, In Progress, Done. Создайте задачи в Backlog списке и перемещайте их в соответствующий список(In Progress, Done) в зависимости от их статуса.

## Послесловие

Основная идея выполнения задач к этому проекту заключается в том, чтобы получить небольшой опыт в решении практических задач и расширении функционала, набить шишки, копаясь в чужом коде, и ознакомиться с архитектурой приложения в целом, а также научиться писать свой "production ready" кодешник :) Это задание не будет оцениваться предметно, используя систему баллов, как в предыдущих домашних заданиях, оцениваться будет ваше старание и мотивация разобраться.

