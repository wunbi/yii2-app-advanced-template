<?php namespace front\components\filters;

use Yii;
use yii\base\ActionFilter;

class ModalFilter extends ActionFilter {

    public function beforeAction($action) {
        Yii::$app->controller->errorLayout = 2;

        return parent::beforeAction($action);
    }

}

?>