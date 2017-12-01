<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\helpers\Utility;

/**
 * This is the model class for table "banner".
 *
 * @property integer $id
 * @property integer $type
 * @property string $img
 * @property string $link
 * @property integer $targetid
 * @property integer $created_at
 * @property integer $updated_at
 */
class Banner extends \yii\db\ActiveRecord
{
    public $imageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['img','type'], 'required'],
            [['created_at', 'updated_at','targetid','type'], 'integer'],
            [['imageFile'], 'file', 'extensions' => 'png, jpg'],
            [['link'],'string'],
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
            'type' => '类型',
            'img' => '图片链接',
            'link' => '链接',
            'imageFile' => '图片',
            'targetid' => '对应的新闻详情ID',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
    
    public function upload()
    {
        $destFilePath = '/uploads/banner/' . date('Ymd') . '/' . date('H') . '/';
        $saveFilePath = Yii::getAlias('@webroot') . $destFilePath;
        // var_dump($saveFilePath);exit;
        if (!file_exists($saveFilePath))
        {
            mkdir($saveFilePath, 0777,true);
        }
    
        $fileName = Utility::guid() . "." . $this->imageFile->extension;
    
        $this->imageFile->saveAs($saveFilePath . $fileName);
    
        return Yii::getAlias('@web') . $destFilePath . $fileName;
    }
}
