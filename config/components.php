<?php
return [
    'request' => [
        'cookieValidationKey' => 'fa3e794d9e06350b76ad6f0943052a28',
        'enableCsrfValidation' => false,
        'parsers' => [
            'application/json'  => 'yii\web\JsonParser',
            'text/json'         => 'yii\web\JsonParser',
        ],
    ],
    'errorHandler' => [
        'errorAction' => 'error/catchall',
    ],
    'mailer' => [
        'class' => 'yii\swiftmailer\Mailer',
        'useFileTransport' => true,
    ],
    'urlManager' => [
        'class' => 'yii\web\UrlManager',
        'enablePrettyUrl' => true,
        'showScriptName' => false,
    ],
    'log' => [
        'class' => 'sp_framework\ext\log\SpYiiLogDispatcher',
        'traceLevel' => YII_DEBUG ? 3 : 0,
        'logger' => 'sp_framework\ext\log\SpYiiLogger',
        'targets' => [
            [
                'class' => 'sp_framework\ext\log\SpYiiLogFileTarget',
                'log_level' => 16,
                'log_path' => '/home/saber/logs',
            ],
        ],
    ],
    'db_homework' => [
        'dsn'           => 'mysql:host=123.56.156.172; dbname=homework',
        'username'      => 'homework_rd',
        'password'      => 'Wzj769397',
        'class'         => 'yii\db\Connection',
        'charset'       => 'utf8',
        'attributes'    => [
            PDO::ATTR_TIMEOUT => 1,
        ],
    ],
];