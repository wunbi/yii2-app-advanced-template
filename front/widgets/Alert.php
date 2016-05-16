<?php
namespace front\widgets;

class Alert extends \yii\base\Widget {


    public function init() {
        parent::init();

        if (\Yii::$app->session->hasFlash('alert')) {
            $this->getView()->registerJs("alert('" . \Yii::$app->session->getFlash('alert') . "');");
        }
    }

}
