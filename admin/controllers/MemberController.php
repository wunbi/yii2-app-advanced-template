<?php namespace admin\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use admin\models\forms\LoginForm;
use common\models\entities\Member;
use yii\helpers\Url;

/**
 * UserController implements the CRUD actions for User model.
 */
class MemberController extends BaseController {

    public function init() {
        $this->title = '會員註冊資料管理';
    }

    public function actionIndex() {
        $searchModel = new \admin\models\search\MemberSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel'  => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Member();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            if ($model->save()) {
                Yii::$app->session->setFlash('success', "新增完成");
                return $this->redirect(['update',
                            'id' => $model->id]);
            }
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $hash = true;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if (empty($model->password)) {
                $model->password = $model->getOldAttributes()["password"];
                $hash = false;
            }

            if ($model->validate()) {
                if ($hash) {
                    $model->password = md5($model->password);
                }

                if ($model->save()) {
                    Yii::$app->session->setFlash('success', "修改完成");
                    return $this->redirect(['update',
                                'id' => $model->id]);
                }
            }
        }

        $model->password = null;

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    public function actionStatus($id) {
        $model = $this->findModel($id);
        if ($model->status == 0) {
            $model->status = 2;
        } else {
            $model->status = 0;
        }

        $model->save();

        return $this->redirect(['index']);
    }

    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionLogin() {
        $this->layout = false;
        $this->title = '管理員登入';
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $auth = Yii::$app->authManager;
            $permission = $auth->getPermissionsByRole(Yii::$app->user->identity->role);
            reset($permission);
            $first = key($permission);

            return $this->redirect(Url::toRoute($first . '/index'));
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->redirect(Url::toRoute('user/login'));
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Member::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.', $this->errorLayout);
        }
    }

}
