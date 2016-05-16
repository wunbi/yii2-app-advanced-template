<?php namespace common\controllers;

use Yii;

class JobController extends \yii\web\Controller {

    public function init() {
        parent::init();
        $this->layout = "main";
    }

    public function actionIndex() {

        return $this->render("index");
    }

    public function actionClearcache() {
        Yii::$app->cache->flush();
        echo "clear";
        exit;
    }

}

?>