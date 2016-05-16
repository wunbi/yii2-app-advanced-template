<?php namespace front\controllers;

use Yii;
use \common\models\entities\ClickCount;

class SiteController extends BaseController {

    public function actions() {
        return [
            'captcha' => [
                'class'     => 'yii\captcha\CaptchaAction',
                'maxLength' => 4,
                'minLength' => 4,
                'offset'    => 4,
                'foreColor' => '2113696',
            ],
        ];
    }

    public function actionIndex() {
        return $this->render('index');
    }

}
