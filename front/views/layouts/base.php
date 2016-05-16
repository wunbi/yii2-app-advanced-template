<?php

use front\assets\AppAsset;
use yii\helpers\Html;

$asset = AppAsset::register($this);
$this->beginPage()

?>
<!DOCTYPE html>
<html>
    <head>
        <title><?= Yii::$app->tool->renderPageTitle(); ?></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta name="description" content="description">
        <meta name="keywords" content="keywords">
        <meta name="author" content="author"/>
        <meta property="og:title" content="<?= Yii::$app->tool->renderPageTitle(); ?>" />
        <meta property="og:description" content="description" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="<?= Yii::$app->tool->toCurrent([], true); ?>" />
        <meta property="og:image" content="<?= Yii::$app->controller->metaImage; ?>" />
        <meta property="fb:app_id" content="app_id" />
        <meta property="og:type" content="website"/>
        <?php $this->head() ?>
        <link href="/css/custom.css" rel="stylesheet">
        <?= Html::csrfMetaTags() ?>
    </head>
    <body class="<?= Yii::$app->controller->bodyClass; ?>">
        <?php $this->beginBody() ?>
        <?= $content; ?>
        <?= \front\widgets\Alert::widget() ?>
        <?php $this->endBody() ?>
    </body>

</html>
<?php $this->endPage() ?>
