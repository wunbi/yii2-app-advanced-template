<?php namespace front\components\filters;

use Yii;
use yii\base\ActionFilter;

class ReturlUrlFilter extends ActionFilter {

    public function beforeAction($action) {

        if (Yii::$app->user->isGuest) {

            if ((Yii::$app->controller->errorLayout == 2) || (Yii::$app->request->isAjax)) {
                return parent::beforeAction($action);
            } 

            //設定登入回傳網址(若為modal則在action重設一次)
            Yii::$app->user->returnUrl = Yii::$app->request->absoluteUrl;
        }


        return parent::beforeAction($action);
    }

}

?>