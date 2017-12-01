<?php
namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;
use common\helpers\Utility;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, ipa, apk'],
        ];
    }

    public function upload()
    {
        $destFilePath = '/uploads/headnode/' . date('Ymd') . '/' . date('H') . '/';
        $saveFilePath = \Yii::getAlias('@webroot') . $destFilePath;
        if (!file_exists($saveFilePath))
        {
            mkdir($saveFilePath, 0777, true);
        }
    
        $fileName = Utility::guid() . "." . $this->imageFile->extension;
    
        $this->imageFile->saveAs($saveFilePath . $fileName);
    
        return \Yii::getAlias('@web') . $destFilePath . $fileName;
    }
}