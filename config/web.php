<?php
date_default_timezone_set('America/La_Paz');

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    //'id' => 'basic',
    'id' => '',
    'name' => 'Sistema S.A.C. ',
    'language' => 'es',
    'sourceLanguage' => 'es',
    'timeZone' => 'America/La_Paz',
    
    
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    
    'controllerMap' => [
                'export' => 'phpnt\exportFile\controllers\ExportController'
    ],
    
    'components' => [
        
        'view' => [
                'theme' => [
                    'pathMap' => [
                       '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                    ],
                ],
           ],
        
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'rX4NCca7JHkdgG3YzGvjNsq5ldyrHrpz',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            //'identityClass' => 'app\models\User',
            'identityClass' => 'app\models\Usuarios',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],

        /*'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],*/


        // CODIGO AÑADIDO POR ALVARO CANQUI PARA GUARDAR EL REGISTRO DE LOGS EN UN ARCHIVO
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info'],
                    'categories' => ['yii\db\Command::execute'],
                    'logFile' => '@runtime/logs/db.log',
                ],
            ],
        ],



        'db' => $db,
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
    
    // codigo añadido para iniciar GRIDVIEW instalado por composer
    'modules' => [
         'gridview' => ['class' => 'kartik\grid\Module'],
        'treemanager' =>  [
        'class' => '\kartik\tree\Module',
            // other module settings, refer detailed documentation
        ],
    ], 
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
        'allowedIPs' => ['192.168.172.79', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['192.168.172.79', '::1'],
        //'allowedIPs' => ['127.0.0.1', '::1'],
        'allowedIPs' => ['192.168.172.79', '::1'],
    ];
}

return $config;
