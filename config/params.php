<?php

return [
    'adminEmail' => 'admin@example.com',
    'idAlloc' => [
        'domain'    => 'http://123.56.156.172:4021',
        'apis' => [
            'nextId'    => '/nextId',      //取一个ID
            'batch'     => '/batch',        //取多个ID
        ],
    ],
    'redis' => [
        'host'          => '123.56.156.172:6379',
        'retry'         => '1',
        'timeout'       => 10000,
        'conntimeout'   => 5000,
    ],
    'school-admin' => [
        'domain'    => 'http://123.56.156.172:81',
        'apis' => [
            'getChildList'              => '/study-palace/school-admin/query/getChildList',
            'getStudentOfClass'         => '/study-palace/school-admin/query/getStudentOfClass',
            'getStudentByStudentUuid'   => '/study-palace/school-admin/query/getStudentByStudentUuid',
            'getClassList'              => '/study-palace/school-admin/query/getClassList',
        ],
    ],
];
