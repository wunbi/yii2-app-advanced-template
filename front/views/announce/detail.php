<?php
$this->registerCssFile("/css/frame_4.css", ['depends' => [front\assets\Main1Asset::className()],]);
if ($model->type == "video"){
  $this->registerCssFile("/css/video_detail.css", ['depends' => [front\assets\Main1Asset::className()],]);  
}
$this->registerCssFile("/css/custom_announce.css", ['depends' => [front\assets\Main1Asset::className()],]);

$back = Yii::$app->tool->toBaseUrl(["/announce",
    "type" => $model->type]);

?>
<div class="content">
    <label for="AsideChecker"></label>
    <div class="category">
        <img class="back" src="/image/ui/btn_return_grey.png" alt="返回" onclick="js:location.href = '<?= $back; ?>';">
        <strong><a href='<?= $back; ?>'><?= Yii::$app->params["announceType"][$model->type]; ?></a></strong>
        <a id="<?= $model->id; ?>" onclick="open_browser('http://www.facebook.com/sharer.php?u=<?= $model->share_link; ?>')">
            <img class="fb" src="/image/ui/btn_facebook_blue.png" alt="facebook">
        </a>
    </div>
    <article id='announceDetail'>
        <section>
            <?php if ($model->type == "video"): ?>
                <?php if (Yii::$app->devicedetect->isAndroidOS()): ?>
                    <a onclick="open_youtube('<?= $model->video; ?>')">
                        <div class="pic videoContent">
                            <img src="<?= $model->image; ?>"/>
                        </div>
                    </a>
                <?php else: ?>
                    <div class="video-container">
                        <?= $model->getVideoEmbed(); ?>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="pic">
                    <img src="<?= $model->image; ?>" alt="">
                </div>
            <?php endif; ?>

            <div class="heading">
                <time><?= date("Y/m/d", $model->createtime); ?></time>
                <h2><?= $model->title; ?></h2>
                <span><?= Yii::$app->params["announceType"][$model->type]; ?></span>
            </div>
        </section>
        <p>
            <?= nl2br($model->content); ?>
        </p>
    </article>
</div>