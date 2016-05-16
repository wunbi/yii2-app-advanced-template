<?php namespace common\assets\coralTheme;

use yii\web\AssetBundle;

class SkinCoralAsset extends AssetBundle {

    public $sourcePath = '@common/assets/coralTheme/assets';
    public $css = [
        'css/skin-coral.css',
        'css/main.css',
    ];
    public $depends = [
        'common\assets\coralTheme\CoralBaseAsset'
    ];

}
