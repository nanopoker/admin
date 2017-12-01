<?php
namespace common\helpers;

use yii\imagine\Image;

class Utility
{
    static public function getVerifyCode()
    {
        $str = "1,2,3,4,5,6,7,8,9,a,b,c,d,f,g";
        $list = explode(",", $str);
        $cmax = count($list) - 1;
        $verifyCode = '';
        for ( $i=0; $i < 6; $i++ ){
            $randnum = mt_rand(0, $cmax);
            $verifyCode .= $list[$randnum];
        }
        
        return $verifyCode;
    }
    
    static public function getTimeStr($second)
    {
        if ($second >= 31536000)
        {
            return date('Y年m月d天 H小时i分钟s秒',$second);
        }
        elseif ($second >=2592000)
        {
            return date('m月d天 H小时i分钟s秒',$second);
        }
        elseif ($second >=86400)
        {
            return date('d天 H小时i分钟s秒',$second);
        }
        elseif ($second >=3600)
        {
            return date('H小时i分钟s秒',$second);
        }
        elseif ($second >=60)
        {
            return date('i分钟s秒',$second);
        }
        else
        {
            return date('s秒',$second);
        }
    }
    
    static public function getLeftTimeStr($second)
    {
        $s = '';
        if ($second >= 31536000)
        {
            $s = date('Y年',$second);
        }
        elseif ($second >=2592000)
        {
            $s = date('m月',$second);
        }
        elseif ($second >=86400)
        {
            $s = date('d天',$second);
        }
        elseif ($second >=3600)
        {
            $s = date('H小时',$second);
        }
        elseif ($second >=60)
        {
            $s = date('i分钟',$second);
        }
        else
        {
            $s = date('s秒',$second);
        }
        
        $s .= '前';
        
        return $s;
    }
    
    static public function guid($separated = true)
    {
        // 生成一个随机的md5串, 然后通过分割来 获得guid
        mt_srand ( ( double ) microtime () * 10000 );
        $charid = md5 ( uniqid ( rand (), true ) );
        if (!$separated)
        {
            return $charid;
        }
    
        $hyphen = chr ( 45 ); //'-'
        $uuid = substr ( $charid, 0, 8 )
        . $hyphen
        . substr ( $charid, 8, 4 )
        . $hyphen
        . substr ( $charid, 12, 4 )
        . $hyphen
        . substr ( $charid, 16, 4 )
        . $hyphen
        . substr ( $charid, 20, 12 );
        return $uuid;
    }
    
    static public function upload($uploadFile)
    {
        $allowTypes = ['png', 'jpg', 'jpeg'];
        $allowMaxSize = 1024 * 1024 * 3; 
        $arr = explode('.', $uploadFile['name']);
        $uploadType = end($arr);
        
        if (!in_array($uploadType, $allowTypes)) {
            return ['e'=>1001,'m'=>'图片类型错误，类型为'.$uploadType.'。'];
        }
        
        $uploadSize = $uploadFile['size'];
        if ( $uploadSize > $allowMaxSize ) {
            return ['e'=>1002,'m'=>'图片太大'];
        }
        
        if(!is_uploaded_file($uploadFile['tmp_name'])) {
            return ['e'=>1003,'m'=>'图片上传失败'];
        }
        
        $destFileName = Utility::guid() . '.' . $uploadType;
        $destFilePath = '/uploads/images/' . date('Ymd') . '/' . date('H') . '/';
        
        $saveFilePath = \Yii::getAlias('@webroot') . $destFilePath;
        if (!file_exists($saveFilePath))
        {
            mkdir($saveFilePath, 0777, true);
        }
        if(!move_uploaded_file($uploadFile['tmp_name'], $saveFilePath . $destFileName))
        {
            return ['e'=>1004,'m'=>'图片上传失败'];
        }
        $filePath = \Yii::getAlias('@webroot') . $destFilePath . $destFileName;
        
        $thumbnailPath =  $filePath . ".thumb.".$uploadType;
        Image::thumbnail($filePath, 240, 240)->save($thumbnailPath, ['quality' => 50]); 
        
        $imageLink = \Yii::getAlias('@web') . $destFilePath . $destFileName;
        $thumbnailLink = $imageLink  . ".thumb.".$uploadType;
        
        return ['e'=>0,'src'=>$imageLink,'thumb'=>$thumbnailLink];
    }
    
    static public function upload2($filename,$filetmpname,$filesize)
    {
        $allowTypes = ['png', 'jpg', 'jpeg'];
        $allowMaxSize = 1024 * 1024 * 2;
        $arr = explode('.', $filename);
        $uploadType = end($arr);
    
        if (!in_array($uploadType, $allowTypes)) {
            return ['e'=>1001,'m'=>'图片类型错误，类型为'.$uploadType.'。'];
        }
    
        $uploadSize = $filesize;
        if ( $uploadSize > $allowMaxSize ) {
            return ['e'=>1002,'m'=>'图片太大'];
        }
    
        if(!is_uploaded_file($filetmpname)) {
            return ['e'=>1003,'m'=>'图片上传失败'];
        }
    
        $destFileName = Utility::guid() . '.' . $uploadType;
        $destFilePath = '/uploads/images/' . date('Ymd') . '/' . date('H') . '/';
    
        $saveFilePath = \Yii::getAlias('@webroot') . $destFilePath;
        if (!file_exists($saveFilePath))
        {
            mkdir($saveFilePath, 0777, true);
        }
        if(!move_uploaded_file($filetmpname, $saveFilePath . $destFileName))
        {
            return ['e'=>1004,'m'=>'图片上传失败'];
        }
        $filePath = \Yii::getAlias('@webroot') . $destFilePath . $destFileName;
    
        $thumbnailPath =  $filePath . ".thumb.".$uploadType;
        Image::thumbnail($filePath, 240, 240)->save($thumbnailPath, ['quality' => 50]);
    
        $imageLink = \Yii::getAlias('@web') . $destFilePath . $destFileName;
        $thumbnailLink = $imageLink  . ".thumb.".$uploadType;
    
        return ['e'=>0,'src'=>$imageLink,'thumb'=>$thumbnailLink];
    }
    
    static public function isMobile($mobile) {
        if (!is_numeric($mobile)) {
            return false;
        }
        return preg_match('/^1[3,4,5,7,8]{1}\d{9}$/', $mobile) ? true : false;
    }
    
    static public function filterWords($str)
    {
        $badword = array();

        $badword1 = array_combine($badword,array_fill(0,count($badword),'*'));
        $str = strtr($str, $badword1);
        
        return $str;
    }
}