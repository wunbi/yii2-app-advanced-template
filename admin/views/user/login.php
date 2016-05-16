<?php

use common\assets\coralTheme\SkinDarkAsset;
use yii\helpers\Html;

use yii\widgets\ActiveForm;

SkinDarkAsset::register($this);
$this->beginPage();

?>
<!DOCTYPE html>
<html class="paceSimple app footer-sticky">
    <head>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode(Yii::$app->controller->title) ?></title>
        <?php $this->head() ?>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class=" loginWrapper menu-right-hidden">
        <?php $this->beginBody() ?>
        <!-- Main Container Fluid -->
        <div class="container-fluid menu-hidden">
            <!-- Content -->
            <div id="content">
                <div class="layout-app">

                    <!-- row-app -->
                    <div class="row row-app">
                        <!-- col -->
                        <!-- col-separator.box -->
                        <div class="col-separator col-unscrollable box">

                            <!-- col-table -->
                            <div class="col-table">

                                <h4 class="innerAll margin-none border-bottom text-center"><i class="fa fa-lock"></i> <?= Yii::$app->controller->title; ?></h4>

                                <!-- col-table-row -->
                                <div class="col-table-row">
                                    <!-- col-app -->
                                    <div class="col-app col-unscrollable">
                                        <!-- col-app -->
                                        <div class="col-app">
                                            <div class="login">
                                                <div class="placeholder text-center"><i class="fa fa-lock"></i></div>
                                                <div class="panel panel-default col-sm-6 col-sm-offset-3">

                                                    <div class="panel-body">
                                                        <?php
                                                        $form = ActiveForm::begin([
                                                                    'id'                     => 'form',
                                                                    "validateOnSubmit"       => true,
                                                                    'enableClientValidation' => true,
                                                                    'options'                => [
                                                                        'enctype' => 'multipart/form-data'],
                                                        ]);

                                                        ?>

                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">帳號</label>
                                                            <?=
                                                            $form->field($model, 'username', [
                                                                'template' => "{input}\n{error}",
                                                            ])->input('email', [
                                                                'placeholder' => "帳號",
                                                                'class'       => 'form-control',
                                                                'required'    => 'required',
                                                            ]);

                                                            ?>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">密碼</label>
                                                            <?=
                                                            $form->field($model, 'password', [
                                                                'template' => "{input}\n{error}",
                                                            ])->passwordInput([
                                                                'placeholder' => "密碼",
                                                                'class'       => 'form-control',
                                                            ]);

                                                            ?>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary btn-block">登入</button>
                                                        <?php ActiveForm::end(); ?>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <!-- // END col-app -->

                                    </div>
                                    <!-- // END col-app.col-unscrollable -->

                                </div>
                                <!-- // END col-table-row -->
                            </div>
                            <!-- // END col-table -->
                        </div>
                        <!-- // END col-separator.box -->
                    </div>
                    <!-- // END row-app -->
                </div>
            </div>
        </div>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>