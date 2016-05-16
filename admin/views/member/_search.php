<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'id'     => 'searchForm'
        ]);

?>
<div class="col-xs-6 col-md-3">
    <?= $form->field($model, 'keyword')->textInput(['placeholder' => '輸入編號、帳號、真實姓名或Email']);

    ?>
</div>
<div class="col-xs-6 col-md-3">
    <?=
    $form->field($model, 'status')->dropDownList(Yii::$app->params["memberStatus"], ["class"  => "form-control",
        'prompt' => '全部']);

    ?>
</div>
<div class="col-xs-6 col-md-3">
    <?=
    $form->field($model, 'query_start')->widget(
            'trntv\yii\datetime\DateTimeWidget', ['phpDatetimeFormat'    => 'yyyy/MM/dd HH:mm',
        'momentDatetimeFormat' => 'YYYY/MM/DD HH:mm',
        'options'              => ['placeholder' => '註冊時間查詢，請選擇查詢開始時間'],
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
<div class="col-xs-6 col-md-3">
    <?=
    $form->field($model, 'query_end')->widget(
            'trntv\yii\datetime\DateTimeWidget', ['phpDatetimeFormat'    => 'yyyy/MM/dd HH:mm',
        'momentDatetimeFormat' => 'YYYY/MM/DD HH:mm',
        'options'              => ['placeholder' => '註冊時間查詢，請選擇查詢結束時間'],
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
<div class="col-md-12 col-xs-12">
    <?= Html::submitButton("搜尋", ['class' => 'btn btn-primary']) ?>
</div>


<?php ActiveForm::end(); ?>         
