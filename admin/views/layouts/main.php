<?php

use common\assets\coralTheme\SkinDarkAsset;
use yii\helpers\Html;
use common\widgets\Alert;

$user = Yii::$app->user;

$asset = SkinDarkAsset::register($this);
$this->registerJsFile('/js/main.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJs('$("textarea").autosize();');
$staticUrl = Yii::$app->params["staticFileUrl"];
$this->beginPage()

?>
<!DOCTYPE html>
<html class="paceSimple app sidebar sidebar-fusion sidebar-kis footer-sticky navbar-sticky">

    <head>
        <?= Html::csrfMetaTags() ?>
        <title><?= (YII_ENV_DEV ? "Sandbox " : "") . Html::encode(Yii::$app->controller->title) ?></title>
        <?php $this->head() ?>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

    </head>
    <body class="menu-right-hidden">
        <?php $this->beginBody() ?>
        <!-- Main Container Fluid -->
        <div class="container-fluid">
            <!-- Main Sidebar Menu -->
            <div id="menu" class="hidden-print hidden-xs">
                <div id="sidebar-fusion-wrapper">
                    <div id="brandWrapper">
                        <a href="/" class="display-block-inline pull-left logo"><img src="<?= $asset->baseUrl . '/images/app-logo-style-default.png' ?>" alt=""></a>
                        <a href="/"><span class="text"><?= Yii::$app->controller->title; ?></span></a>
                    </div>
                    <ul class="menu list-unstyled" id="navigation_current_page">
                        <?php if ($user->can('member')): ?>
                            <li class="">
                                <a href="<?= Yii::$app->tool->toBaseUrl(["member/index"]); ?>">
                                    <i class="fa fa-child"></i>
                                    <span>會員註冊資料管理</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if ($user->can('announce')): ?>
                            <li class="">
                                <a href="<?= Yii::$app->tool->toBaseUrl(["announce/index"]); ?>">
                                    <i class="fa fa-user"></i>
                                    <span>資訊發佈</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if ($user->can('user')): ?>
                            <li class="">
                                <a href="<?= Yii::$app->tool->toBaseUrl(["user/index"]); ?>">
                                    <i class="fa fa-user"></i>
                                    <span>後台帳號管理</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if ($user->can('permission')): ?>
                            <li class="">
                                <a href="<?= Yii::$app->tool->toBaseUrl(["permission/index"]); ?>">
                                    <i class="fa fa-key"></i>
                                    <span>權限管理</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <!-- Content -->
            <div id="content">
                <div class="navbar hidden-print box main navbar-inverse" role="navigation">
                    <div class="user-action user-action-btn-navbar pull-left border-right">
                        <button class="btn btn-sm btn-navbar btn-primary btn-stroke"><i class="fa fa-bars fa-2x"></i></button>
                    </div>
                    <div class="user-action pull-right menu-right-hidden-xs menu-left-hidden-xs">
                        <div class="dropdown username pull-left">
                            <a class="dropdown-toggle " data-toggle="dropdown" href="#">
                                <span class="media margin-none">
                                    <span class="">
                                        <?= Yii::$app->user->identity->name; ?>
                                        <span class="caret"></span> 
                                    </span>
                                </span>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="<?= Yii::$app->tool->toBaseUrl(["user/logout"]); ?>">登出</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- // END navbar -->
                <div class="layout-app">
                    <!-- row -->
                    <div class="row row-app margin-none">
                        <!-- col -->
                        <div class="col-md-12">
                            <!-- col-separator -->
                            <div class="col-separator col-separator-first border-none">
                                <!-- col-table -->
                                <div class="innerAll">
                                    <?= Alert::widget() ?>
                                    <?= $content; ?>
                                </div>
                                <!-- // END col-table -->
                            </div>
                            <!-- // END col-separator -->
                        </div>
                        <!-- // END col -->
                    </div>
                    <!-- // END row-app -->
                </div>
            </div>
            <!-- // Content END -->
            <div class="clearfix"></div>
            <!-- // Sidebar menu & content wrapper END -->
        </div>
        <!-- // Main Container Fluid END -->
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>