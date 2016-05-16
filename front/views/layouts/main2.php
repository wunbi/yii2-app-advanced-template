<?php
$this->beginContent('@app/views/layouts/base.php');
front\assets\Main2Asset::register($this);

?>
<div class="content">
    <header>
        <?php if (!isset(Yii::$app->params["tmpFb"])): ?>
            <img src="/image/ui/btn_return_white.png" alt="返回" onclick="js:location.href = '/';">
        <?php else: ?>
            <img src="/image/ui/icon_facebook.png" alt="facebook">
        <?php endif; ?>
        <h3><?= Yii::$app->controller->subTitle; ?></h3>
    </header>
    <?= $content; ?>
</div>

<?php $this->endContent(); ?>