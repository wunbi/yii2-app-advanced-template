<?php namespace common\assets\coralTheme;

use yii\web\AssetBundle;

class CoralBaseAsset extends AssetBundle {

    public $sourcePath = '@common/assets/coralTheme/assets';
    public $css = [
        'icons/fontawesome/assets/css/font-awesome.min.css',
    ];
    public $js = [
        'js/modernizr/modernizr.js',
        'js/sidebar.main.init.js',
        'js/jquery.autosize-min.js',
        'js/init.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        //'yii\jui\JuiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];

}
