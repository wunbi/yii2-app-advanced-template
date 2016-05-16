<?php
$this->beginContent('@app/views/layouts/menu.php');
$this->registerCssFile("/css/search_list.css", ['depends' => [front\assets\Main1Asset::className()],]);
front\assets\Main1Asset::register($this);

?>
<div class="content">
    <label for="AsideChecker"></label>
    <div class="keyword" style="margin-top: 50px;">
        <img src="../image/ui/btn_return_grey.png" alt="返回" onclick="js:location.href = '/announce';">
        <strong><?= Yii::$app->params["tmpKeyword"]; ?></strong>
    </div>
    <?= $content; ?>

</div>


<?php $this->endContent(); ?>