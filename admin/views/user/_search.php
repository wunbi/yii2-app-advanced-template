<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'id'     => 'searchForm'
        ]);

?>
<div class="col-md-4 col-xs-6">
    <?= $form->field($model, 'keyword')->textInput(['placeholder' => '輸入帳號或暱稱']);

    ?>
</div>
<div class="col-md-4 col-xs-6">
    <?= $form->field($model, 'role')->dropDownList(Yii::$app->params["adminRoleType"], ["class"       => "form-control",
        'prompt'      => '全部']);

    ?>
</div>
<div class="col-md-4 col-xs-6">
    <?= $form->field($model, 'status')->dropDownList(Yii::$app->params["statusList"], ["class"       => "form-control",
        'prompt'      => '全部']);

    ?>
</div>
<div class="col-md-12 col-xs-12">
<?= Html::submitButton("搜尋", ['class' => 'btn btn-primary']) ?>
</div>


<?php ActiveForm::end(); ?>         
