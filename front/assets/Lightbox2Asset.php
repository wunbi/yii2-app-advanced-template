<?php namespace front\assets;

use Yii;
use yii\web\AssetBundle;

class Lightbox2Asset extends AssetBundle {

    public $baseUrl = '@web/js/lightbox2';
    
    public $css = [
        'css/lightbox.css',
    ];
    public $js = [
        'js/lightbox.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
