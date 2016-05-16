<?php namespace common\assets\coralTheme;

use yii\web\AssetBundle;

class SkinDefaultAsset extends AssetBundle {

    public $sourcePath = '@common/assets/coralTheme/assets';
    public $css = [
        'css/skin-default.css',
        'css/main.css',
    ];
    public $depends = [
        'common\assets\coralTheme\CoralBaseAsset'
    ];

}
