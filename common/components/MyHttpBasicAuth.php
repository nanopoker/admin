<?php
namespace common\components;
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 15/5/19
 * Time: 下午13:12
 */
class MyHttpBasicAuth extends \yii\filters\auth\HttpBasicAuth
{
    public function challenge($response)
    {
        /*
         *  $response->header('Access-Control-Allow-Origin' , '*');
    $response->header('Access-Control-Allow-Methods', 'GET, POST, PUT, OPTIONS');
    $response->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization');

         */

        $headers =$response->headers;
        $headers->set('Access-Control-Allow-Origin', '*');

        $headers->set('Access-Control-Allow-Methods', ['GET','POST', 'PUT', 'OPTIONS']);
        $headers->set('Access-Control-Allow-Headers', ['Origin', 'Content-Type', 'Accept', 'Authorization']);
    }

    public function beforeAction($action) {
         $request = \Yii::$app->request;
        if ($request->isOptions) {
            return true;
        }
        else {
            return parent::beforeAction($action);
        }
   
    }
}