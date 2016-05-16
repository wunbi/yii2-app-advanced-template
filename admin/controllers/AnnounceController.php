<?php namespace admin\controllers;

use Yii;
use common\models\entities\Announce;
use common\models\search\AnnounceSearch;
use admin\controllers\BaseController;
use yii\web\NotFoundHttpException;

/**
 * AnnounceController implements the CRUD actions for Announce model.
 */
class AnnounceController extends BaseController {

    public function init() {
        $this->title = '資訊發佈';
    }

    /**
     * Lists all Announce models.
     * @return mixed
     */
    public function actionIndex() {

        $searchModel = new AnnounceSearch();
        $this->title = '資訊發佈';

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel'  => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Room model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Announce();
        $this->title = '資訊發佈';

        $model->image = Yii::$app->params["staticFileUrl"] . "/images/announce.jpg";

        if ($model->load(Yii::$app->request->post())) {
            $uploadPath = Yii::getAlias('@common') . "/web";
            $_image = \yii\web\UploadedFile::getInstance($model, 'image');
            if ($_image) {
                $imageFileName = "/uploads/announce/" . time() . '.' . $_image->extension;
                $_image->saveAs($uploadPath . $imageFileName);
                //縮圖
                Yii::$app->tool->thumbnailByWithRatio($uploadPath . $imageFileName, $uploadPath . $imageFileName, "announce");
                $model->image = $imageFileName;
            }


            if ($model->validate() && $model->save()) {
                Yii::$app->session->setFlash('success', "新增完成");

                return $this->redirect(['update',
                            'id' => $model->id]);
            }
        }

        return $this->render('create', [
                    'model' => $model
        ]);
    }

    /**
     * Updates an existing Room model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        $this->title = '資訊發佈';

        if ($model->load(Yii::$app->request->post())) {
            $uploadPath = Yii::getAlias('@common') . "/web";

            $_image = \yii\web\UploadedFile::getInstance($model, 'image');
            if ($_image) {
                $imageFileName = "/uploads/announce/" . $model->id . '.' . $_image->extension;
                $_image->saveAs($uploadPath . $imageFileName);
                //縮圖
                Yii::$app->tool->thumbnailByWithRatio($uploadPath . $imageFileName, $uploadPath . $imageFileName, "announce");
                $model->image = Yii::$app->params["staticFileUrl"] . $imageFileName;
            } else {
                $model->image = $model->getOldAttribute("image");
            }

            if ($model->validate() && $model->save()) {
                Yii::$app->session->setFlash('success', "修改完成");
                return $this->redirect(['update',
                            'id' => $model->id]);
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    public function actionDelete($id) {
        $model = $this->findModel($id);
        $model->status = -1;
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Announce model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Announce the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Announce::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.', $this->errorLayout);
        }
    }

    public function actions() {
        return [
            'images-get'   => [
                'class' => 'vova07\imperavi\actions\GetAction',
                'url'   => Yii::$app->params["staticFileUrl"] . '/uploads/announce/',
                'path'  => '@common/web/uploads/announce',
                'type'  => \vova07\imperavi\actions\GetAction::TYPE_IMAGES,
            ],
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                'url'   => Yii::$app->params["staticFileUrl"] . '/uploads/announce/',
                'path'  => '@common/web/uploads/announce'
            ],
        ];
    }

}
