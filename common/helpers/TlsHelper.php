<?php
namespace common\helpers;

use Yii;
use common\models\SendMessageLog;
use common\models\SystemMessage;

/**
 * Created by PhpStorm.
 * User: teavoid
 * Date: 15/12/12
 * Time: 14:54
 */
class TlsHelper {
    static function signature($identifier, $expiry_after)
    {
        $tls_appid = "1400008560";
        $appid_at_3rd = "1400008560";//独立模式下与 sdkappid 一样，集成模式下第三方开放平台账号的 appid
        $account_type = "4403"; //独立模式

        //$expiry_after = 3600 * 24;

        $tls_signature_path = Yii::getAlias("@storage") . '/tls/bin/signature';
        $private_key_path = Yii::getAlias("@storage") . '/tls/private_key';
        $command = $tls_signature_path
            . ' '. escapeshellarg($private_key_path)
            . ' ' . escapeshellarg($expiry_after)
            . ' ' . escapeshellarg($tls_appid)
            . ' ' . escapeshellarg($account_type)
            . ' ' . escapeshellarg($appid_at_3rd)
            . ' ' .escapeshellarg($identifier);
        
        $ret = exec($command, $out, $status);
        
        if( $status == -1)
        {
            return '';
        }
        
        return $out[0];
    }
    
    static function getAPI()
    {
        require_once Yii::getAlias("@storage") . '/PhpServerSdk/TimRestApi.php';
        require_once Yii::getAlias("@storage") . '/PhpServerSdk/TimRestInterface.php';
        
        $sdkappid = "1400008560";
        $identifier = "admin1";
        
        $api = createRestAPI();
        $api->init($sdkappid, $identifier);
        
        $cache = Yii::$app->cache;
        if (!$cache->exists('user_sig'))
        {
            $private_key_path = Yii::getAlias("@storage") . '/tls/private_key';
            $signature = Yii::getAlias("@storage") . '/PhpServerSdk/signature/linux-signature64';
            $user_sig = $api->generate_user_sig($identifier, '86400', $private_key_path, $signature);
            if ($user_sig == null)
            {
                echo 'get user_sig null';
                exit();
            }
            $cache->set('user_sig', $user_sig[0], 80000);
        }
        else
        {
            $ret = $api->set_user_sig($cache->get('user_sig'));
            if ($ret == false)
            {
                echo 'set user_sig false';
                exit();
            }
        }
        
        return $api;
    }
    
    static function pushMessage($content,$uid,$type)
    {
        $api = TlsHelper::getAPI();
        
        if ($type == 1)   //one
        {
            $ret = $api->openim_send_msg("admin1", (string)$uid, (string)$content);
        }
        else    //all
        {
            $ret = $api->openim_batch_sendmsg((string)$uid, (string)$content);
        }
        
        TlsHelper::sendMessageLog($content, $uid, $ret);
        
        return $ret;
    }
    
    static function accountImport($uid,$nick,$headnode)
    {
        $api = TlsHelper::getAPI();
    
        $ret = $api->account_import((string)$uid, $nick, $headnode);
    
        return $ret;
    }
    
    static function accountGet($uid)
    {
        $api = TlsHelper::getAPI();
    
        $ret = $api->profile_portrait_get((string)$uid);
    
        return $ret;
    }
    
    static function sendMessageLog($content,$uid,$ret)
    {
        $model = new SendMessageLog();
        $model->content = $content;
        $model->uid = $uid;
        $model->ret = json_encode($ret);
        $model->save();
    }

    //系统消息和定向推送消息存储
    static function sendSystemMessage($title,$content,$receiver){
        $message = new SystemMessage();
        $message->title = $title;
        $message->content = $content;
        $message->receiverid = $receiver;
        $message->save();
    }

    //后台审核消息推送
    static function pushMessage3($title,$content,$account){

        $api = TlsHelper::getAPI();
        $ret = $api->openim_send_msg("admin4", (string)$account, (string)$content);
        TlsHelper::sendMessageLog($content, $account, $ret);
        TlsHelper::sendSystemMessage($title,(string)$content,$account);
        unset($api);

        return $ret;
    }

}