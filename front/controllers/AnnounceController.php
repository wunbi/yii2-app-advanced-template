<?php namespace front\controllers;

use Yii;
use \common\models\entities\ClickCount;

class AnnounceController extends BaseController {

    public function init() {
        parent::init();
    }

    public function actionIndex($keyword = null) {
        Yii::$app->params["tmpType"] = null;

        Yii::$app->tool->setPageMetaData("資訊公告");

        $searchModel = new \common\models\search\AnnounceSearch();

        if ($keyword) {
            $searchModel->keyword = $keyword;
        }
        $searchModel->isAvailable = true;
        $dataProvider = $searchModel->search([]);

        return $this->render("index", [
                    "dataProvider" => $dataProvider,
        ]);
    }

    public function actionDetail($id) {
        $model = $this->loadModel($id);

        Yii::$app->tool->setPageMetaData($model->title);

        return $this->render("detail", [
                    "model" => $model,
        ]);
    }

    private function loadModel($id) {
        $model = \common\models\entities\Announce::findOne(["id"     => $id,
                    "status" => 1]);
        if (!$model) {
            throw new yii\web\NotFoundHttpException('很抱歉查無資料');
        }
        return $model;
    }

}
