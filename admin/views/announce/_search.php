<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin([
            'action' => ['index',
                'type' => $type,],
            'method' => 'get',
            'id'     => 'searchForm'
        ]);

?>
<div class="col-xs-6 col-md-4">
    <?=
    $form->field($model, 'query_start')->widget(
            'trntv\yii\datetime\DateTimeWidget', ['phpDatetimeFormat'    => 'yyyy/MM/dd HH:mm',
        'momentDatetimeFormat' => 'YYYY/MM/DD HH:mm',
        'options'              => ['placeholder' => '請選擇查詢開始時間'],
        'clientOptions'        => [
            'locale'            => 'zh-tw',
            'useCurrent'        => true,
            'allowInputToggle'  => true,
            'showClose'         => true,
            'widgetPositioning' => [
                'horizontal' => 'auto',
                'vertical'   => 'auto'
            ],
        ]]
    );

    ?>
</div>
<div class="col-xs-6 col-md-4">
    <?=
    $form->field($model, 'query_end')->widget(
            'trntv\yii\datetime\DateTimeWidget', ['phpDatetimeFormat'    => 'yyyy/MM/dd HH:mm',
        'momentDatetimeFormat' => 'YYYY/MM/DD HH:mm',
        'options'              => ['placeholder' => '請選擇查詢結束時間'],
        'clientOptions'        => [
            'locale'            => 'zh-tw',
            'useCurrent'        => true,
            'allowInputToggle'  => true,
            'showClose'         => true,
            'widgetPositioning' => [
                'horizontal' => 'auto',
                'vertical'   => 'auto'
            ],
        ]]
    );

    ?>
</div>
<div class="col-xs-12 col-md-4">
    <?= $form->field($model, 'keyword')->textInput(['placeholder' => '請輸入關鍵字']);

    ?>
</div>

<div class="col-md-12">
    <?= Html::submitButton("搜尋", ['class' => 'btn btn-primary']) ?>
</div>


<?php ActiveForm::end(); ?>         

