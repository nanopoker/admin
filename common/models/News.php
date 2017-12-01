<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\models\NewsImage;
use common\models\AdminUser;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $content
 * @property integer $uid
 * @property string $status
 * @property integer $views
 * @property integer $comments
 * @property datetime $created_at
 * @property datetime $updated_at
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'uid'], 'required'],
            [['uid', 'views', 'comments'], 'integer'],
            [['content'], 'string'],
        ];
    }
    
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => '内容',
            'uid' => '作者',
            'status' => '状态',
            'views' => '浏览数',
            'comments' => '评论数',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    public function getNewsImage()
    {
        return $this->hasMany(NewsImage::className(), ['newsid' => 'id']);
    }
    
    public function getUser()
    {
        return $this->hasOne(AdminUser::className(), ['id' => 'uid']);
    }
}
