<?php namespace admin\components\filters;

use Yii;
use yii\base\ActionFilter;

class PermissionFilter extends ActionFilter {

    public function beforeAction($action) {
        $_controller = Yii::$app->controller;
        $_user = Yii::$app->user;

        //店長直接給所有權限
        if ($_user->identity->role == 1) {
            return true;
        }

        //角色權限
        if ($_user->can(strtolower($_controller->id))) {
            return true;
        }
        throw new \yii\web\HttpException(400, "您的權限不足", Yii::$app->controller->errorLayout);

        return false;
    }

}

?>