<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->registerCss(".layout-app .col-separator{background-color: transparent;}");

?>
<div class="admin-index">
    <?php \yii\widgets\Pjax::begin(); ?>
    <div class="widget">
        <div class="widget-body row">
            <div class="col-xs-12 col-md-12">
                <p>
                    <?= $this->render('_search', ['model' => $searchModel]); ?>
                </p>
            </div>
        </div>
    </div>
    <div class="widget">
        <div class="widget-body row">
            <div class="col-xs-12 col-md-12">
                <p>
                    <?= Html::a('新增', ['create'], ['class' => 'btn btn-primary']) ?>
                </p>

                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'options'      => ["class" => 'table-responsive table-primary'],
                    'tableOptions' => [
                        'class' => 'table table-striped',
                    ],
                    'columns'      => [
                        array(
                            'attribute'      => "id",
                            "contentOptions" => array(
                                "style" => "width:70px;",
                            ),
                        ),
                        'username',
                        'name',
                        array(
                            'format'    => 'raw',
                            'attribute' => 'status',
                            'value'     => function($data) {
                                return Yii::$app->params["statusList"][$data->status];
                            },
                        ),
                        array(
                            'format'    => 'raw',
                            'attribute' => 'role',
                            'value'     => function($data) {
                                return Yii::$app->params["adminRoleType"][$data->role];
                            },
                        ),
                        array(
                            'attribute' => "created_at",
                            'format'    => 'raw',
                            'value'     => function($data) {
                                return date("Y/m/d H:i", $data->created_at);
                            }
                        ),
                        [
                            'header'   => "操作",
                            'class'    => 'yii\grid\ActionColumn',
                            //'headerOptions' => ['class' => 'grid-operate-col'],
                            'template' => '{update}{status}{delete}',
                            'buttons'  => [
                                'update' => function ($url, $model) {
                                    return Html::a('<i class="fa fa-edit fa-fw"></i> 編輯', ['update',
                                                'id' => $model->id], [
                                                'title'     => '編輯',
                                                'class'     => 'btn btn-sm btn-primary',
                                                'data-pjax' => "0",
                                    ]);
                                },
                                        'status'   => function ($url, $model) {
                                    $type = $model->status == 1 ? "停用" : "啟用";
                                    return Html::a('<i class="fa fa-unlock-alt fa-fw"></i> ' . $type, ['status',
                                                'id' => $model->id], [
                                                'title' => $type,
                                                'class' => 'btn btn-sm btn-info',
                                                'data'  => [
                                                    'confirm' => "確定{$type}這筆資料?",
                                                    'method'  => 'post',
                                                ]
                                    ]);
                                },
                                        'delete' => function ($url, $model) {
                                    return Html::a('<i class="fa fa-trash-o fa-fw"></i> 刪除', ['delete',
                                                'id' => $model->id], [
                                                'title' => '刪除',
                                                'class' => 'btn btn-sm btn-danger',
                                                'data'  => [
                                                    'confirm' => '確定刪除這筆資料?',
                                                    'method'  => 'post',
                                                ]
                                    ]);
                                },
                                    ],
                                ],
                            ],
                        ]);

                        ?>
                    </div>
                </div>
            </div>
            <?php \yii\widgets\Pjax::end(); ?>
</div>
