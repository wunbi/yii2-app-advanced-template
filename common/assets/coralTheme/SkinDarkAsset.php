<?php namespace common\assets\coralTheme;

use yii\web\AssetBundle;

class SkinDarkAsset extends AssetBundle {

    public $sourcePath = '@common/assets/coralTheme/assets';
    public $css = [
        'css/skin-dark.css',
        'css/main.css',
    ];
    public $depends = [
        'common\assets\coralTheme\CoralBaseAsset'
    ];

}
