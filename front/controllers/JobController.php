<?php namespace front\controllers;

use Yii;

class JobController extends \yii\console\Controller {

    public function init() {
        parent::init();
        $this->layout = false;
        ini_set('max_execution_time', 3000);
    }

    public function actionClearcache() {
        Yii::$app->cache->flush();
        echo "clear";
        exit;
    }

}

?>