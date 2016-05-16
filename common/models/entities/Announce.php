<?php namespace common\models\entities;

use Yii;

/**
 * This is the model class for table "announce".
 *
 * @property integer $id
 * @property string $type
 * @property string $title
 * @property string $content
 * @property string $image
 * @property string $keyword
 * @property integer $modtime
 * @property integer $createtime
 */
class Announce extends \common\models\entities\Base {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'announce';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [[
            'type',
            'title',
            'start_time',
            'end_time',
            'content'],
                'required'],
            [[
            'content',
            'keyword'],
                'string'],
            [[
            'status',
            'start_time',
            'end_time',
            'modtime',
            'createtime'],
                'integer'],
            [[
            'title',
            'image'],
                'string',
                'max' => 255],
            [[
            'image'],
                'file',
                'extensions' => 'jpg, gif, png',
                'maxSize'    => 4 * 1024 * 1024
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id'         => 'ID',
            'type'       => '分類',
            'status'     => '啟用狀態',
            'title'      => '標題',
            'content'    => '內文',
            'image'      => '圖片',
            'start_time' => '開始時間',
            'end_time'   => '結束時間',
            'keyword'    => '關鍵字',
            'modtime'    => '最後修改',
            'createtime' => '建立時間',
        ];
    }

    public function beforeSave($insert) {
        if (empty($this->image)) {
            $this->image = Yii::$app->params["staticFileUrl"] . "/images/announce.jpg";
        }
        if (strpos($this->image, "http") !== 0) {
            $this->image = Yii::$app->params["staticFileUrl"] . $this->image;
        }


        $keyword = [];
        $keyword[] = $this->id;
        $keyword[] = $this->title;
        $keyword[] = strip_tags($this->content);
        $keyword[] = $this->image;
        $this->keyword = implode("", $keyword);
        $this->keyword = str_replace(" ", "", $this->keyword);

        return parent::beforeSave($insert);
    }

}
