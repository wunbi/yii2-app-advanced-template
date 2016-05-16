<?php

use nirvana\infinitescroll\InfiniteScrollPager;
if(Yii::$app->controller->layout == "announce"){
   $this->registerCssFile("/css/frame_3.css", ['depends' => [front\assets\Main1Asset::className()],]); 
}

$this->registerCss("body{ height: auto; } html, body{ overflow: scroll; }");

?>

<?=
yii\widgets\ListView::widget([
    "id"           => "listview",
    'dataProvider' => $dataProvider,
    'itemView'     => '_announce',
    'layout'       => '<ul class="announce_content">{items}{pager}</ul>',
    'options'      => [
        "class" => "content"
    ],
    'itemOptions'  => [
        'tag' => false,
    ],
    "viewParams"   => [
        "type" => $type
    ],
    'pager'        => [
        'class'                 => InfiniteScrollPager::className(),
        'widgetId'              => "listview",
        'itemsCssClass'         => 'announce_content',
        'contentLoadedCallback' => 'null',
        'nextPageLabel'         => null,
        'linkOptions'           => [],
        'pluginOptions'         => [
            "loading" => [
                "finishedMsg" => "已經沒有資料囉",
                "msgText"     => "讀取中...",
            ],
        ],
    ],
]);

?>

