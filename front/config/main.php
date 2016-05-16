<?php
return [
    'id'                  => 'front',
    'basePath'            => dirname(__DIR__),
    'bootstrap'           => ['log'],
    'controllerNamespace' => 'front\controllers',
    'defaultRoute'        => 'site/index',
    'components'          => [
        'user'         => [
            'class'           => 'front\components\User',
            'identityClass'   => 'common\models\entities\Member',
            'enableAutoLogin' => true,
            'loginUrl'        => ["user/gologin"],
            'identityCookie'  => ['name' => '_member'],
        ],
        'socialLogin'  => [
            'class' => 'front\components\SocialLogin',
        ],
        'request'      => [
            'enableCookieValidation' => true,
            'enableCsrfValidation'   => true,
            'cookieValidationKey'    => 'hwbeefh51e3fad921ap16w0608c5fc47',
        ],
        'errorHandler' => [
            'errorAction' => 'base/error',
        ],
        'view'         => [
            'class'            => '\rmrevin\yii\minify\View',
            'enableMinify'     => !YII_DEBUG,
            'web_path'         => '@web', // path alias to web base
            'base_path'        => '@webroot', // path alias to web base
            'minify_path'      => '@webroot/minify', // path alias to save minify result
            'js_position'      => [ \yii\web\View::POS_END], // positions of js files to be minified
            'force_charset'    => 'UTF-8', // charset forcibly assign, otherwise will use all of the files found charset
            'expand_imports'   => true, // whether to change @import on content
            'compress_output'  => true, // compress result html page
            'compress_options' => ['extra' => true], // options for compress
        ]
    ],
];

?>