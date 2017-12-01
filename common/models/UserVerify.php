<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "user_verify".
 *
 * @property integer $id
 * @property integer $uid
 * @property string $name
 * @property string $company
 * @property string $job
 * @property string $id_front
 * @property string $id_back
 * @property string $phone
 * @property integer $status
 * @property string $reason
 * @property integer $created_at
 * @property integer $updated_at
 */
class UserVerify extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $gender;
    public static function tableName()
    {
        return 'user_verify';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'name', 'company', 'job', 'phone'], 'required'],
            [['uid', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'company', 'job', 'reason'], 'string'],
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
            'name' => '姓名',
            'phone'=>'电话',
            'email'=>'邮箱',
            'company' => '所在公司',
            'job' => '职务',
            'phone' => '手机号',
            'status' => '审核状态',
            'reason' => '原因',
            'created_at' => '申请时间',
            'gender'=>'性别',
        ];
    }
}
