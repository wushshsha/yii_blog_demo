<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'language' =>'zh-CN',//设置默认语言为中文
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\UserModel',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [   //开启路由美化功能
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            //'suffix' =>'.html', //美化后缀
            'rules' => [
            ],
        ],
        'i18n' =>[  //语言包配置
            'translations' =>[
                '*' =>[
                    'class' =>'yii\i18n\PhpMessageSource',
                    //'basePath' =>'/messages',
                    'fileMap' => [
                        'common' => 'common.php',
                    ]
                ]
            ]
        ]
    ],
    'params' => $params,
];
