<div class="imageBlock center">
    <label class="control-label"><?= $model->getAttributeLabel($name); ?></label><br/>
    <?php if (!empty($model->$name)): ?>
        <a href="<?= $model->$name . "?v=" . time(); ?>" target="_blank" class="imageLink">
            <img src="<?= $model->$name . "?v=" . time(); ?>" class="imageContent img-s100">
        </a>
    <?php else: ?>
        <a href="#" class="imageLink">
            <img src="http://common.fooli.xyz/images/no_image.png" class="imageContent img-s100">
        </a>
    <?php endif; ?>
    <button type="button" class="btn btn-inverse uploadButton">
        <i class="fa fa-edit"></i>選擇照片
        <br/>
            建議尺寸<?= Yii::$app->params["thumbWidth"]["announce"]["width"] . " x " . Yii::$app->params["thumbWidth"]["announce"]["height"]; ?>
    </button>
    <?=
    $form->field($model, $name, [
        'template' => "{input}\n{error}",
    ])->fileInput(["style" => 'height:0px; opacity:0;display:none;']);

    ?>
</div>