<?php
$params = require(__DIR__ . '/params.php');
$params["staticFileUrl"] = "http://fbcommon.happygomap.com";

$dbHost = "127.0.0.1";
$dbName = "dbname";
$dbUsername = "user";
$dbPassword = "passwd";

$other_config = [];

$_ips = ["*"];

$other_config['bootstrap'][] = 'debug';
$other_config['modules']['debug'] = [
    'class'      => 'yii\debug\Module',
    'allowedIPs' => $_ips
];
$other_config['bootstrap'][] = 'gii';
$other_config['modules']['gii'] = [
    'class'      => 'yii\gii\Module',
    'allowedIPs' => $_ips
];

$config = [
    'id'                  => 'common',
    'basePath'            => dirname(__DIR__),
    'bootstrap'           => ['log'],
    'controllerNamespace' => 'common\controllers',
    'defaultRoute'        => 'site/index',
    'language'            => 'zh-TW',
    'sourceLanguage'      => 'en-US',
    'timezone'            => 'Asia/Taipei',
    'vendorPath'          => dirname(dirname(__DIR__)) . '/vendor',
    'modules'             => [
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ]
    ],
    'components'          => [
        'db'           => [
            'class'              => 'yii\db\Connection',
            'dsn'                => "mysql:host={$dbHost};dbname={$dbName}",
            'username'           => $dbUsername,
            'password'           => $dbPassword,
            'charset'            => 'utf8',
            'enableSchemaCache'  => true,
            'enableQueryCache'   => true,
            'queryCacheDuration' => 86400,
            'queryCache'         => 'cache',
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'      => 'yii\log\FileTarget',
                    'except'     => ['yii\web\HttpException:404'],
                    'levels'     => [
                        'error',
                        'warning'],
                    'categories' => ['yii\*',
                        'application'],
                    'logFile'    => '@app/runtime/logs/' . date("Y-m-d", time()) . '.txt',
                ],
            ],
        ],
        'request'      => [
            'enableCookieValidation' => true,
            'enableCsrfValidation'   => true,
            'cookieValidationKey'    => 'dbaeefa51e3fsd9f1h21670608c5fc47',
        ],
        'cache'        => [
            'class' => 'yii\caching\FileCache',
        ],
        'mailer'       => [
            'class'     => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class'      => 'Swift_SmtpTransport',
                'host'       => 'SMTP host',
                'username'   => 'SMTP name',
                'password'   => 'SMTP password',
                'port'       => '25',
                'encryption' => 'tls',
            ],
            'viewPath'  => '@common/mail',
        ],
        'urlManager'   => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
        //'rules'           => require(__DIR__ . '/routes.php'),
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
//                    'js'         => [
//                        $params["staticFileUrl"] . '/js/jquery.min.js',
//                    ],
                    'sourcePath' => null, // do not publish the bundle
                    'js'         => [
                        '//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js',
                    ]
                ],
            ],
        ],
        'tool'         => [
            'class' => 'common\components\Tool',
        ],
        'authClientCollection' => [
            'class'   => 'yii\authclient\Collection',
            'clients' => [
                'facebook' => [
                    'name'         => 'facebook',
                    'class'        => 'yii\authclient\clients\Facebook',
                    'clientId'     => '689115637784686',
                    'clientSecret' => '7140096346283c50ac6a5dd06763cc2a',
                    'scope'        => 'email,public_profile,user_friends',
                    'authUrl'      => 'https://www.facebook.com/dialog/oauth',
                    'viewOptions'  => ['popupWidth'  => 500,
                        'popupHeight' => 450,]
                ],
            ],
        ],
    ],
    'params'              => $params,
];

return yii\helpers\ArrayHelper::merge(
                $config, $other_config
);

?>
