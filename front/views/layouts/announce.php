<?php
$this->beginContent('@app/views/layouts/menu.php');
front\assets\Main1Asset::register($this);
$this->registerCssFile("/css/custom_announce.css", ['depends' => [front\assets\Main1Asset::className()],]);

?>

<ul class="tag">
    <li><a class="<?= (Yii::$app->params["tmpType"] == "about") ? "underline" : null; ?>" href="<?=
        Yii::$app->tool->toBaseUrl(["/announce",
            "type" => "about"]);

        ?>">飢餓三十源起</a></li>
    <li><a class="<?= (Yii::$app->params["tmpType"] == "announce") ? "underline" : null; ?>" href="<?=
        Yii::$app->tool->toBaseUrl(["/announce",
            "type" => "announce"]);

        ?>">最新消息</a></li>
    <li><a class="<?= (Yii::$app->params["tmpType"] == "care") ? "underline" : null; ?>" href="<?=
        Yii::$app->tool->toBaseUrl(["/announce",
            "type" => "care"]);

        ?>">國際關懷</a></li>
    <li><a class="<?= (Yii::$app->params["tmpType"] == "help") ? "underline" : null; ?>" href="<?=
        Yii::$app->tool->toBaseUrl(["/announce",
            "type" => "help"]);

        ?>">國內關懷</a></li>
    <li><a class="<?= (Yii::$app->params["tmpType"] == "video") ? "underline" : null; ?>" href="<?=
        Yii::$app->tool->toBaseUrl(["/announce",
            "type" => "video"]);

        ?>">影音花絮</a></li>
</ul>
<?= $content; ?>

<?php $this->endContent(); ?>