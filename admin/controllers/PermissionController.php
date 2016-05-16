<?php namespace admin\controllers;

use Yii;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;

/**
 * UserController implements the CRUD actions for User model.
 */
class PermissionController extends BaseController {

    public function init() {
        $this->title = "權限管理";
        $this->enableCsrfValidation = false;
    }

    public function actionIndex() {
        $dataAry = $columns = [];

        $auth = Yii::$app->authManager;
        //只挑選本店家權限
        $_cnt = 1;

        foreach ($auth->getPermissions() as $key => $value) {
            $_tmp = array(
                'id'    => $_cnt,
                'label' => $value->description,
            );
            $_tmp["assign_1"] = Html::checkbox("assign_item", true, ["disabled" => true]);
//            $_tmp["assign_1"] = Html::checkbox("assign_item", $auth->hasChild($auth->getRole("1"), $value), ["class"     => "role-assign",
//                        "data-name" => $value->name,
//                        "data-role" => 1]);
            $_tmp["assign_2"] = Html::checkbox("assign_item", $auth->hasChild($auth->getRole("2"), $value), ["class"     => "role-assign",
                        "data-name" => $value->name,
                        "data-role" => 2]);
            $_tmp["assign_3"] = Html::checkbox("assign_item", $auth->hasChild($auth->getRole("3"), $value), ["class"     => "role-assign",
                        "data-name" => $value->name,
                        "data-role" => 3]);

            $dataAry[] = $_tmp;
            $_cnt++;
        }

        $dataProvider = new ArrayDataProvider(['allModels'  => $dataAry,
            'pagination' => false]);

        $columns[] = array(
            "header"  => "功能",
            'format'  => 'raw',
            'options' => ["style" => "width:20%;"],
            "value"   => function($data) {
        return $data["label"];
    }
        );
        foreach (Yii::$app->params["adminRoleType"] as $key => $value) {
            $columns[] = array(
                "header" => $value,
                'format' => 'raw',
                "value"  => function($data) use ($key) {
                    return $data["assign_" . $key];
                }
            );
        }

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    "columns"      => $columns
        ]);
    }

    public function actionUpdate() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $item = Yii::$app->request->post("item");
        $role = Yii::$app->request->post("role");
        if (!($item || $role)) {
            return "缺少參數";
        }

        $auth = Yii::$app->authManager;
        $item = $auth->getPermission($item);
        $role = $auth->getRole($role);
        if ($auth->hasChild($role, $item)) {
            //刪除
            $auth->removeChild($role, $item);
        } else {
            //新增
            $auth->addChild($role, $item);
        }

        //清cache
        Yii::$app->cache->flush();

        return "success";
    }

}
