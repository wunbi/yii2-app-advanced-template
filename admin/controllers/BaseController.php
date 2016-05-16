<?php namespace admin\controllers;

use Yii;

class BaseController extends \common\controllers\BaseController {

    const ERROR_NORMAL = 1;
    const ERROR_MODAL = 2;

    public $errorLayout = self::ERROR_NORMAL;
    public $layout = 'main';
    public $title = '系統管理介面';

    public function behaviors() {

        return \yii\helpers\ArrayHelper::merge([
                    'access' => [
                        'class'  => \yii\filters\AccessControl::className(),
                        'except' => ['login',
                            'error'],
                        'rules'  => [
                            [
                                'allow' => true,
                                'roles' => ['@'],
                            ],
                        ],
                    ],
                    [
                        'class'  => '\admin\components\filters\PermissionFilter',
                        'except' => ['login',
                            'gologin',
                            'error',
                            'logout'],
                    ],
                        ], parent::behaviors());
    }

    public function actionError() {
        $exception = Yii::$app->errorHandler->exception;

        $_code = $exception->getCode();
        if ($_code == self::ERROR_MODAL) {
            $this->layout = "modal";
        }

        if ($exception !== null) {
            return $this->render("@common/views/error", array(
                        "exception" => $exception));
        }
        exit;
    }

}
