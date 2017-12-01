<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\imagine\Image;
use common\helpers\Utility;

class UploadController extends Controller
{
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        return $this->render('index');
    }

    //单张图片上传
    public function actionImage()
    {

               if (!isset($_FILES['file'])) {
                   $result = ["code" => 101, "message" => "没有图片"];
                   echo json_encode($result);
                   return;
               }

               $uploadFile = $_FILES['file'];

              $allowTypes = ['png', 'jpg', 'jpeg'];
        $allowMaxSize = 1024 * 1024 * 3; 
        $arr = explode('.', $uploadFile['name']);
        $uploadType = end($arr);

                      if ( !in_array($uploadType, $allowTypes)) {
                          $result = ["code" => 102, "message" => "图片类型错误", 'uploadType' => $uploadType];
                          echo json_encode($result);
                          return;
                      }

                      $uploadSize = $uploadFile['size'];
                      if ( $uploadSize > $allowMaxSize ) {
                          $result = ["code" => 103, "message" => "图片太大"];
                          echo json_encode($result);
                          return;
                      }

                             if(!is_uploaded_file($uploadFile['tmp_name'])) {
                                 $result = ["code" => 104, "message" => "图片上传失败01"];
                                 echo json_encode($result);
                                 return;
                             }

                                     $destFileName = Utility::guid() . '.' . $uploadType;
                                     $destFilePath = '/uploads/images/' . date('Ymd') . '/' . date('H') . '/';

                                     $saveFilePath = Yii::getAlias('@webroot') . $destFilePath;
                                    if (!file_exists($saveFilePath))
                                     {
                                         mkdir($saveFilePath, 0777, true);
                                     }
                                     if(!move_uploaded_file($uploadFile['tmp_name'], $saveFilePath . $destFileName))
                                     {
                                         $result = ["code" => 104, "message" => "图片保存失败01"];
                                         echo json_encode($result);
                                         return;
                                     }
        $filePath = Yii::getAlias('@webroot') . $destFilePath . $destFileName;
        $thumbnailPath =  $filePath . ".thumb.".$uploadType;
        Image::thumbnail($filePath, 120, 120)->save($thumbnailPath, ['quality' => 50]);
        $imageLink = Yii::getAlias('@web') . $destFilePath . $destFileName;
        $thumbnailLink = $imageLink  . ".thumb.".$uploadType;
        $result = ["code"=> 0, "link" => $imageLink, 'thumbnail' => $thumbnailLink];
        echo json_encode($result);
        return;
    }

    //多张图片上传
    public function actionImages()
    {

        if (!isset($_POST['fileId'])) {
            $result = ["code" => 105, "message" => "缺少必要参数"];
            echo json_encode($result);
            return;
        }

        $fileId = $_POST['fileId'];


        if (!isset($_FILES['file'])) {
            $result = ["code" => 101, "message" => "没有图片", "fileId" => $fileId];
            echo json_encode($result);
            return;
        }

        $uploadFile = $_FILES['file'];

        $allowTypes = ['png', 'jpg', 'jpeg'];
        $allowMaxSize = 1024 * 1024 * 3; 
        $arr = explode('.', $uploadFile['name'][0]);
        $uploadType = end($arr);
        if ( !in_array($uploadType, $allowTypes)) {
            $result = ["code" => 102, "message" => "图片类型错误", 'uploadType' => $uploadType, "fileId" => $fileId];
            echo json_encode($result);
            return;
        }

        $uploadSize = $uploadFile['size'][0];
        if ( $uploadSize > $allowMaxSize ) {
            $result = ["code" => 103, "message" => "图片太大", "fileId" => $fileId];
            echo json_encode($result);
            return;
        }

        if(!is_uploaded_file($uploadFile['tmp_name'][0])) {
            $result = ["code" => 104, "message" => "图片上传失败01", "fileId" => $fileId];
            echo json_encode($result);
            return;
        }

        $destFileName = Utility::guid() . '.' . $uploadType;
        $destFilePath = '/uploads/images/' . date('Ymd') . '/' . date('H') . '/';

        $saveFilePath = Yii::getAlias('@webroot') . $destFilePath;
        if (!file_exists($saveFilePath))
        {
            mkdir($saveFilePath, 0777, true);
        }

        if(!move_uploaded_file($uploadFile['tmp_name'][0], $saveFilePath . $destFileName))
        {
            $result = ["code" => 104, "message" => "图片保存失败01", "fileId" => $fileId];
            echo json_encode($result);
            return;
        }

        $filePath = Yii::getAlias('@webroot') . $destFilePath . $destFileName;
        $thumbnailPath =  $filePath . ".thumb.".$uploadType;
        Image::thumbnail($filePath, 120, 120)->save($thumbnailPath, ['quality' => 50]);

        $imageLink = Yii::getAlias('@web') . $destFilePath . $destFileName;
        $thumbnailLink = $imageLink  . ".thumb.".$uploadType;
        $result = ["code"=> 0, "link" => $imageLink, 'thumbnail' => $thumbnailLink, "fileId" => $fileId];
        echo json_encode($result);
        return;
    }
}
