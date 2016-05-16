<?php namespace front\components;

use Yii;
use yii\web\IdentityInterface;

class User extends \yii\web\User {

    public function getIsLoggedIn() {
        return !$this->getIsGuest();
    }

    public function login(IdentityInterface $identity, $duration = 0) {
        return parent::login($identity, $duration);
    }

    /**
     * 
     * overwrite 存到session
     */
    public function setIdentity($identity) {
        parent::setIdentity($identity);
        Yii::$app->session["_userInfo"] = $identity;
    }

    /**
     * 
     * overwrite 存到session
     */
    public function getIdentity($autoRenew = true) {
        if (!Yii::$app->session["_userInfo"]) {
            Yii::$app->session["_userInfo"] = parent::getIdentity($autoRenew);
        }
        return Yii::$app->session["_userInfo"];
    }

}
