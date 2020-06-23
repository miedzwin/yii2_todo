# yii2_todo

Here is PHP application with docker to run on any device that supports docker.
To start application just run `docker-compose up -d --build`. Remember to have Docker and docker-compose installed.
After appication build enter PHP container and install dependencies by running: `docker-compose exec php bash` open folder with application: `cd todo` and install dependencies by running: `composer install`.

Aplication is inside `todo` folder. This is minimal Yii2 installation - to me makes no sense to install everything if I need only Controllers, Forms and access to DB.

In root folders is file with configuration, it should work properly with docker - no neew to change there anything. I create migrations to create tables in DB. Application code is inside `src` folder. In `Controllers` folder are 2 controllers. `UserController` is for handling user registration and user login. `TaskController` is for creating, updating tasks in DB.
`Form` folder contain forms to handle data that user passes to API. I create them to perform validation on data that user passes to API. `Models` folder contains classes to handle connection with DB to create and modify records.
