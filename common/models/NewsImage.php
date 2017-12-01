<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "news_image".
 *
 * @property integer $id
 * @property integer $newsid
 * @property string $image
 * @property string $image_thumb
 */
class NewsImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['newsid', 'image', 'image_thumb'], 'required'],
            [['id','newsid'], 'integer'],
            [['image', 'image_thumb'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'newsid' => 'Newsid',
            'image' => 'Image',
            'image_thumb' => 'Image Thumb',
        ];
    }
}
