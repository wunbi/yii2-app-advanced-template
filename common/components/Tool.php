<?php namespace common\components;

use Yii;
use yii\base\Component;
use yii\helpers\Url;
use common\models\entities\EmailCheckCodes;
use linslin\yii2\curl;

class Tool extends Component {

    public function toBaseUrl($route, $fullPath = false) {
        return Url::to($route, $fullPath);
    }

    public function toCommonUrl($route) {
        return Yii::$app->params["staticFileUrl"] . Url::to($route);
    }

    /**
     * 
     * @param type $paramAry ["keyy"=>"value"]
     * @return type
     */
    public function toCurrent($paramAry, $scheme = false) {

        return Url::current($paramAry, $scheme);
    }

    public function setMenuActive($controller) {
        return (strtolower($controller) == strtolower(Yii::$app->controller->id)) ? "active" : null;
    }

    /**
     * 產生home url 的靜態檔案路徑
     */
    public function buildHomeFileUrl($path) {
        $_url = Url::home() . "/" . $path;

        return $_url;
    }

    public function utf8_substr($StrInput, $strStart, $strLen) {
        //對字串做URL Eecode
        $StrInput = mb_substr($StrInput, $strStart, mb_strlen($StrInput));
        $iString = urlencode($StrInput);
        $lstrResult = "";
        $istrLen = 0;
        $k = 0;
        do {
            $lstrChar = substr($iString, $k, 1);
            if ($lstrChar == "%") {
                $ThisChr = hexdec(substr($iString, $k + 1, 2));
                if ($ThisChr >= 128) {
                    if ($istrLen + 3 < $strLen) {
                        $lstrResult .= urldecode(substr($iString, $k, 9));
                        $k = $k + 9;
                        $istrLen += 3;
                    } else {
                        $k = $k + 9;
                        $istrLen += 3;
                    }
                } else {
                    $lstrResult .= urldecode(substr($iString, $k, 3));
                    $k = $k + 3;
                    $istrLen += 2;
                }
            } else {
                $lstrResult .= urldecode(substr($iString, $k, 1));
                $k = $k + 1;
                $istrLen++;
            }
        } while ($k < strlen($iString) && $istrLen < $strLen);
        return $lstrResult;
    }

    public function formatErrorMsg($errorsAry, $displayHtml = true) {
        if (!$errorsAry) {
            return null;
        }
        $result = "";

        foreach ($errorsAry as $key => $value) {
            for ($i = 0; $i < count($value); $i++) {
                $result .= $value[$i];
            }
            if ($displayHtml) {
                $result .= "<br/>";
            }
        }

        return $result;
    }

    public function generatorRandomString($length = 7, $prefix = "", $numOnly = false) {
        $password_len = $length;
        $password = $prefix;

        if ($numOnly) {
            $word = '123456789';
        } else {
            // remove o,0,1,l
            $word = 'abcdefghjkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ23456789';
        }

        $len = strlen($word);

        for ($i = 0; $i < $password_len; $i++) {
            $password .= $word[rand() % $len];
        }

        return $password;
    }

    public function generatorHashString($input, $length = 13, $prefix = "FT") {
        $result = md5($input . uniqid("fiti", true));
        $result = substr($result, 0, $length);
        $result = $prefix . strtoupper($result);

        return $result;
    }

    public function generatorCheckCode($store_id, $date) {
        $result = md5($store_id . $date);
        $result = base_convert($result, 16, 10);
        $result = substr($result, 0, 4);

        return $result;
    }

    public function sendMail($toEmail, $toBcc = null, $subject = null, $parameter = array(), $viewName = "default") {
        
        $response = Yii::$app->mailer->compose($viewName, $parameter)
                ->setFrom(Yii::$app->params["noReplyEmail"])
                ->setTo($toEmail)
                ->setSubject($subject);

        if (($toEmail != $toBcc) && ($toBcc != null)) {
            $response->setBcc($toBcc);
        }

        $result = $response->send();

        return $result;
    }

    public function sendUserEmailCheckCode($user, $type = "regist", $other = null) {
        $emailModel = new \common\models\entities\EmailCheckCodes;
        $checkCode = $this->generatorRandomString();

        $emailModel->deleteAll("member_id = '{$user->id}'");
        $emailModel->attributes = array(
            "member_id" => $user->id,
            "check_code" => $checkCode,
            'email'     => $user->email,
            'type'      => $type,
            'other'     => $other,
        );

        if (!$emailModel->save()) {
            throw new \yii\web\HttpException(400, $this->formatErrorMsg($emailModel->getErrors()), Yii::$app->controller->errorLayout);
        }

        if ($type == EmailCheckCodes::TYPE_REGIST) {
            $subject = Yii::$app->params["mailCheckCodeTitle"]["register"];
            $view = "emailcheck";
            $url = $this->toBaseUrl(["user/regist-email-confirm",
                "checkCode" => $checkCode], true);
        } elseif ($type == EmailCheckCodes::TYPE_FORGET_PASSWORD) {
            $subject = Yii::$app->params["mailCheckCodeTitle"]["forgetPwd"];
            $view = "emailforgetpwd";
            $url = $this->toBaseUrl(["user/forget-pwd-confirm",
                "checkCode" => $checkCode], true);
        } else {
            throw new \yii\web\HttpException(400, "認證碼類型有誤", Yii::$app->controller->errorLayout);
        }

        return $this->sendMail($user->email, $user->email, $subject, array(
                    "user"  => $user,
                    "url"   => $url,
                    "other" => $other,
                        ), $view);
    }

    public function mask_email($email, $mask_char = "*", $percent = 50) {
        list($user, $domain) = preg_split("/@/", $email);
        $len = strlen($user);
        $mask_count = floor($len * $percent / 100);
        $offset = floor(($len - $mask_count) / 2);
        $masked = substr($user, 0, $offset) . str_repeat($mask_char, $mask_count) . substr($user, $mask_count + $offset);

        return ($masked . '@' . $domain);
    }

    public function generateArrayRange($min, $max) {
        $ary = range($min, $max);
        return array_combine($ary, $ary);
    }

    /**
     * 產生微秒+隨機亂數(1~9)
     */
    public function getRandomBaseOnMillisecond() {
        $time = explode(" ", microtime());
        $time = $time[1] . ($time[0] * 1000);
        $time2 = explode(".", $time);
        $time = $time2[0];
        return str_pad($time . rand(1, 9), 14, '0', STR_PAD_RIGHT);
    }

    public function utf8_for_xml($string) {
        return preg_replace('/[^\x{0009}\x{000a}\x{000d}\x{0020}-\x{D7FF}\x{E000}-\x{FFFD}]+/u', ' ', $string);
    }

    public function thumbnailByWithRatio($source, $target, $type = "member") {
        //縮圖
        $imagine = new \Imagine\Gd\Imagine();
        $_image = $imagine->open($source);
//        $_width = $_image->getSize()->getWidth();
//        $_height = $_image->getSize()->getHeight();
        $_thumbWidth = Yii::$app->params["thumbWidth"][$type]["width"];
        $_thumbHeight = Yii::$app->params["thumbWidth"][$type]["height"];
//        \yii\imagine\Image::thumbnail($source, $_thumbWidth, (int)(($_thumbWidth / $_width) * $_height), 'inset')
//                ->save($target, ['quality' => 80]);
        \yii\imagine\Image::thumbnail($source, $_thumbWidth, $_thumbHeight, 'outbound')
                ->save($target, ['quality' => 80]);
    }

    public function isJson($string) {
        $array = json_decode($string, true);
        return !empty($string) && is_string($string) && is_array($array) && !empty($array) && json_last_error() == 0;
    }

    public function setMetaImageSize($type) {
        return Yii::$app->controller->metaImageSize = '<meta property="og:image:width" content="' . Yii::$app->params["thumbWidth"][$type]["width"] . '"/><meta property="og:image:height" content="' . Yii::$app->params["thumbWidth"][$type]["height"] . '"/>';
    }

    /**
     * 取下一個元素
     * @param type $array
     * @param type $key
     * @return type
     */
    public function getNextArrayItem($array, $key) {
        $keys = array_keys($array);
        if ((false !== ($p = array_search($key, $keys) + 1)) && ($p < count($keys))) {
            return $array[$keys[$p]];
        } else {
            $key = current(array_keys($array));
            return $array[current(array_keys($array))];
        }
    }

    /**
     * 取上一個元素
     * @param type $array
     * @param type $key
     * @return type
     */
    public function getPrevArrayItem($array, $key) {
        $keys = array_keys($array);
        if ((false !== ($p = array_search($key, $keys) - 1)) && ($p >= 0)) {
            return $array[$keys[$p]];
        } else {
            $key = key(array_slice($array, -1, 1, TRUE));
            return $array[$key];
        }
    }

    /**
     * 設定HTML metadata
     */
    public function setPageMetaData($title) {
        $_controller = Yii::$app->controller;
        $_controller->title[] = $title;
    }

    public function renderPageTitle() {
        $result = array_reverse(Yii::$app->controller->title);
        $result[] = "飢餓三十行動APP";

        return (YII_ENV_DEV ? "Sandbox " : "") . implode(" | ", $result);
    }

}

?>