<?php

use kartik\widgets\ActiveForm;
use vova07\imperavi\Widget;
use yii\helpers\Url;

?>

<div class="admin-form">

    <?php
    $form = ActiveForm::begin(['enableClientScript' => true,
                'options'            => ['enctype' => 'multipart/form-data']]);

    ?>
    <?= $form->errorSummary($model); ?>

    <div class="col-xs-12 col-md-12">
        <?= $form->field($model, 'title')->textInput(['maxlength' => 60])->hint("字數限制60字以內") ?>
    </div>
    <div class="col-xs-12 col-md-12">
        <?=
        $form->field($model, 'content')->widget(Widget::className(), [
            'settings' => [
                'lang'             => 'zh_tw',
                'minHeight'        => 500,
                'pastePlainText'   => true,
                'imageManagerJson' => Url::to(['/announce/images-get']),
                'imageUpload'      => Url::to(['/announce/image-upload']),
                'plugins'          => [
                    'fontsize',
                    'fontcolor',
                    'table',
                    'textdirection',
                    'imagemanager',
                ]
            ]
        ]);

        ?>
    </div>
    <div class="col-xs-6 col-md-6">
        <?=
        $form->field($model, 'start_time')->widget(
                'trntv\yii\datetime\DateTimeWidget', ['phpDatetimeFormat'    => 'yyyy/MM/dd HH:mm',
            'momentDatetimeFormat' => 'YYYY/MM/DD HH:mm',
            'options'              => ['placeholder' => '請選擇日期時間(yyyy/mm/dd H:i)'],
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
    <div class="col-xs-6 col-md-6">
        <?=
        $form->field($model, 'end_time')->widget(
                'trntv\yii\datetime\DateTimeWidget', ['phpDatetimeFormat'    => 'yyyy/MM/dd HH:mm',
            'momentDatetimeFormat' => 'YYYY/MM/DD HH:mm',
            'options'              => ['placeholder' => '請選擇日期時間(yyyy/mm/dd H:i)'],
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

    <?php
    $this->registerJs("imagePreview();");

    ?>
    <div class="col-xs-12 col-md-12">
        <?=
        $this->render("_image", ["form"  => $form,
            "model" => $model,
            "name"  => "image"]);

        ?>
    </div>

    <div class="col-xs-12 col-md-12 center">
        <div class="form-group">
            <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;確認送出</button>
            <a class="btn btn-default" href="<?=
            Yii::$app->tool->toBaseUrl(["index"]);

            ?>"><i class="fa fa-times"></i>&nbsp;&nbsp;返回</a>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
