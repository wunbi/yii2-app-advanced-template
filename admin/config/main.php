<?php
return [
    'id'                  => 'Admin',
    'basePath'            => dirname(__DIR__),
    'bootstrap'           => ['log'],
    'controllerNamespace' => 'admin\controllers',
    'defaultRoute'        => 'user/index',
    'components'          => [
        'authManager'  => [
            //'class'           => 'yii\rbac\DbManager',
            'class'           => 'common\components\CachedDbManager',
            'itemTable'       => 'auth_item',
            'itemChildTable'  => 'auth_item_child',
            'assignmentTable' => 'auth_assignment',
            'ruleTable'       => 'auth_rule',
        ],
        'user'         => [
            'class'           => 'admin\components\User',
            'identityClass'   => 'common\models\entities\Admin',
            'enableAutoLogin' => true,
            'loginUrl'        => ["user/login"],
            'identityCookie'  => ['name' => '_admin'],
        ],
        'request'      => [
            'enableCookieValidation' => true,
            'enableCsrfValidation'   => true,
            'cookieValidationKey'    => '6baeefa5173fad921ep1670s08c5fc47',
        ],
        'errorHandler' => [
            'errorAction' => 'base/error',
        ],
    ],
];
