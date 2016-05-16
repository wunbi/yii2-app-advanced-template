<?php
//環境設定
require(__DIR__ . '/../../common/config/environment.php');

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../common/config/bootstrap.php');
require(__DIR__ . '/../config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
                require(__DIR__ . '/../../common/config/main.php'), require(__DIR__ . '/../config/main.php')
);

$application = new yii\web\Application($config);
$application->run();
