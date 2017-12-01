<?php
namespace common\helpers;

use common\models\Channel;
use yii\helpers\ArrayHelper;
use common\models\PointImage;
use common\models\Point;
use common\models\NewsPoint;
use common\models\PointChannel;
class DataHelper
{
    static public function getValue($data,$key)
    {
        if (isset($data[$key]))
        {
            return $data[$key];
        }
        else
        {
            return '';
        }
    }
    
    static public function getReportType()
    {
        return ['1'=>'观点','2'=>'评论','3'=>'快讯','4'=>'用户'];
    }

    static public function getReportStatus()
    {
        return ['0'=>'新建','1'=>'处理中','2'=>'已处理','3'=>'拒绝处理'];
    }

    static public function getAdviceStatus()
    {
        return ['0'=>'新建','1'=>'处理中','2'=>'已处理','3'=>'拒绝处理'];
    }
    
    static public function getPointStatus()
    {
        return ['0'=>'正常','-1'=>'删除'];
    }
    
    static public function getPointAnonymous()
    {
        return ['0'=>'否','1'=>'是'];
    }
    
    static public function getNewsStatus()
    {
        return ['0'=>'正常','-1'=>'删除'];
    }
    
    static public function getUserType()
    {
        return ['0'=>'普通用户','1'=>'认证用户','2'=>'后台用户'];
    }
    
    static public function getUserVerifyStatus()
    {
        return ['0'=>'认证中','1'=>'认证记者','2'=>'认证失败'];
    }

    static public function getUserStatus(){
        return ['10'=>'正常','11'=>'已冻结'];
    }

    static public function getUserGender(){
        return ['0'=>'女','1'=>'男'];
    }
    
    static public function getChannel()
    {
        $models = Channel::find()->all();
        return ArrayHelper::map($models,'id','name');
    }
    
    static public function getPointImageHtml($point_image)
    {
        $html = '';
        
        foreach ($point_image as $i) {
            $html .= '<img src="http://'.$_SERVER['HTTP_HOST'].$i->image.'" class="img-responsive img-style" />';
        }
        
        return $html;
    }
    
    static public function getNewsImageHtml($news_image)
    {
        $html = '';
        
        foreach ($news_image as $i) {
            $html .= '<img src="http://'.$_SERVER['HTTP_HOST'].$i->image.'" class="img-responsive img-style" />';
        }
        
        return $html;
    }

    static public function getWebviewImage($image)
    {
        $html = '<img src="http://'.$_SERVER['HTTP_HOST'].$image.'" class="img-responsive img-style" />';
        
        return $html;
    }
    
    static public function getNewsPointHtml($newsid)
    {
        $html = '';
    
        $news_point = NewsPoint::find()->with('point')->where(['newsid'=>$newsid])->all();
        $i=1;
        foreach ($news_point as $n_p) {
            $html .= '<p>'.$i.'. '.$n_p->point->title.'</p>';
            $i++;
        }
    
        return $html;
    }
    
    static public function getPointChannelHtml($pointid)
    {
        $html = '';
    
        $pointid_channel = PointChannel::find()->with('channel')->where(['pointid'=>$pointid])->all();
        $i=1;
        foreach ($pointid_channel as $p_c) {
            $html .= '<p>'.$i.'. '.$p_c->channel->name.'</p>';
            $i++;
        }
    
        return $html;
    }
    
    static public function getPointTitle($id)
    {
        $point = Point::findOne($id);
        if (is_object($point)) {
            return $point->title;
        }
        else
        {
            return '';
        }
    }
}