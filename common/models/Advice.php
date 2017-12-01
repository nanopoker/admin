<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "advice".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $uid
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Advice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'advice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'uid'], 'required'],
            [['uid', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['content'], 'string', 'max' => 200]
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
            'title' => '标题',
            'content' => '内容',
            'uid' => '用户',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
    
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'uid']);
    }
}
