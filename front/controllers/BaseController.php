<?php namespace front\controllers;

use Yii;

class BaseController extends \common\controllers\BaseController {

    const ERROR_NORMAL = 1;
    const ERROR_MODAL = 2;

    public $errorLayout = self::ERROR_NORMAL;
    public $layout = 'main';
    public $title = [];
    public $subTitle;
    public $metaImage = "";
    public $metaImageSize;
    public $bodyClass;

    public function actionError() {
        $exception = Yii::$app->errorHandler->exception;
        $_code = $exception->getCode();

        if ($_code == self::ERROR_MODAL) {
            $this->layout = "modal";
        }

        if ($exception !== null) {
            return $this->render("@front/views/error", array(
                        "exception" => $exception));
        }
    }

}
