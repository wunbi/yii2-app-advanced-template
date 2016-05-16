<?php

use common\assets\coralTheme\CoralBaseAsset;

$asset = CoralBaseAsset::register($this);
$this->registerCss(".layout-app .col-separator {
  background-color: transparent;
}");

?>

<div class="row error">
    <div class="col-md-4 col-md-offset-1 center">
        <div class="center">
            <img src="<?= $asset->baseUrl . '/images/error-icon-bucket.png' ?>" class="error-icon">
        </div>
    </div>
    <div class="col-md-5 content center">
        <h1 class="strong">Oups!</h1>
        <h4 class="innerB">This page does not exist.</h4>
        <div class="well">
<?= $exception->getMEssage(); ?>
        </div>
    </div>
</div>