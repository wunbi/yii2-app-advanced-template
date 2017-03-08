<?php namespace common\models\entities;

use Yii;

/**
 * This is the model class for table "announce".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $image
 * @property string $keyword
 * @property integer $updated_at
 * @property integer $created_at
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
            'updated_at',
            'created_at'],
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
            'status'     => '啟用狀態',
            'title'      => '標題',
            'content'    => '內文',
            'image'      => '圖片',
            'start_time' => '開始時間',
            'end_time'   => '結束時間',
            'keyword'    => '關鍵字',
            'updated_at'    => '最後修改',
            'created_at' => '建立時間',
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

        if ($this->start_time !== (int)$this->start_time) {
            $this->start_time = strtotime($this->start_time);
        }

        if ($this->end_time !== (int)$this->end_time) {
            $this->end_time = strtotime($this->end_time);
        }

        return parent::beforeSave($insert);
    }

}
