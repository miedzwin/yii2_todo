<?php
return [
    'id' => 'todo-app',
    // the basePath of the application will be the `app` directory
    'basePath' => __DIR__,
    // this is where the application will find all controllers
    'controllerNamespace' => 'App\Controllers',
    // set an alias to enable autoloading of classes from the 'App' namespace
    'aliases' => [
        '@App' => __DIR__,
    ],
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'pgsql:host=db;dbname=todo',
            'username' => 'dev',
            'password' => 'dev',
            'charset' => 'utf8',
        ],
        'request' => [
            'enableCookieValidation' => true,
            'enableCsrfValidation' => true,
            'cookieValidationKey' => 'gb8348vfr8WERFV4v55V4V',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'user'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'task'],
            ],
        ],
        'user' => [
            'identityClass' => \App\Models\User::class,
//            'class' => \App\Models\User::class,
            'enableAutoLogin' => true,
        ],
    ]
];