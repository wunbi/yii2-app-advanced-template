<?php namespace common\models\entities;

use yii\db\ActiveRecord;

class Base extends ActiveRecord {

    public $param;
    public $param1;
    public $param2;
    public $param3;
    public $param4;
    public $resultObj = ["result"  => true,
        "code"    => 0,
        "message" => null];

    public function init() {
        parent::init();
        $this->loadDefaultValues();
    }

    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            if ($this->hasAttribute("createtime")) {
                $this->createtime = time();
            }
        }

        if ($this->hasAttribute("modtime")) {
            $this->modtime = time();
        }

        return parent::beforeSave($insert);
    }

    public static function getPostfix() {
        $_lang = \Yii::$app->language;
        if ($_lang == "zh-CN") {
            $postfix = "cn";
        } else {
            $postfix = "tw";
        }
        return $postfix;
    }

}
