<li onclick="js:location.href = '<?= Yii::$app->tool->toBaseUrl(["announce/detail",
    "id" => $model->id]); ?>'">
    <div class="pic <?= $type; ?>" style="background-image:url('<?= $model->image; ?>')">
    </div>
    <div class="heading">
        <time><?= date("Y/m/d", $model->createtime); ?></time>
        <h2><?= $model->title; ?></h2>
        <span><?= Yii::$app->params["announceType"][$model->type]; ?></span>
    </div>
</li>