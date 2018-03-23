<?php
return [
    'log' => [
        'targets' => [
            [
                'class' => 'yii\log\FileTarget',
                'levels' => ['error', 'warning'],
//                'levels' => ['trace','info','profile','warning','error'],
            ],
        ],
    ],
    'db_school_admin' => [
        'dsn'           => 'mysql:host=123.56.156.172; dbname=school_admin',
        'username'      => 'school_admin_rd',
        'password'      => 'Wzj769397',
        'class'         => 'yii\db\Connection',
        'charset'       => 'utf8',
        'attributes'    => [
            PDO::ATTR_TIMEOUT => 1,
        ],
    ],
];