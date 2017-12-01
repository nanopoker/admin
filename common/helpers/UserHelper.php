<?php
namespace common\helpers;

use common\models\User;
use common\models\UserVerify;

class UserHelper
{
    static public function getUserArr($uid)
    {
        $user = User::find()->with('verify')->where(['id'=>$uid])->one();
        
        if (is_object($user))
        {
            $user_arr['uid'] = $user->id;
            $user_arr['user_type'] = $user->type;
            $user_arr['username'] = $user->username;
            $user_arr['nickname'] = $user->nick;
            if (!empty($user->headnode) && !empty($user->headnode_thumb))
            {
                $user_arr['headnode'] = 'http://'.$_SERVER['HTTP_HOST'].$user->headnode;
                $user_arr['headnode_thumb'] = 'http://'.$_SERVER['HTTP_HOST'].$user->headnode_thumb;
            }
            else
            {
                $user_arr['headnode'] = '';
                $user_arr['headnode_thumb'] = '';
            }
            
            $user_arr['job'] = '';
            $verify = UserVerify::find()->where(['uid'=>$uid])->one();
            if (is_object($verify))
            {
                $user_arr['job'] = $verify->job;
            }
            
            return $user_arr;
        }
        else
        {
            return [];
        }
    }
    
    static public function getUserName($uid)
    {
        $user = User::find()->where(['id'=>$uid])->one();
        
        if (is_object($user))
        {
            return $user->username;
        }
        else
        {
            '未定义';
        }
    }
    
    static public function getUserType($id)
    {
        $type = DataHelper::getUserType();
        
        if (isset($type[$id]))
            return $type[$id];
        else
            return '未定义';
    }
    
    static public function getUserVerifyStatus($id)
    {
        $type = DataHelper::getUserVerifyStatus();
    
        if (isset($type[$id]))
            return $type[$id];
            else
                return '未定义';
    }

    static public function getUserStatus($id)
    {
        $type = DataHelper::getUserStatus();
        if(isset($type[$id]))
            return $type[$id];
        else
            return '未定义';
    }

    static public function getUserGender($id)
    {
        $type = DataHelper::getUserGender();
        if(isset($type[$id]))
            return $type[$id];
        else
            return '未定义';
    }
}