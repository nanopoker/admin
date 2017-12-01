<?php

namespace backend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\UserVerify;
use common\models\User;
use common\helpers\TlsHelper;

/**
 * VerifyController implements the CRUD actions for UserVerify model.
 */
class UserVerifyController extends Controller{
	public function behaviors()
    {
        return [
        ];
    }

    public function actionIndex(){
    	$count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM user_verify')->queryScalar();
    	$dataProvider = new SqlDataProvider([
    		'totalCount'=>$count,
            'sql' => 'SELECT uv.*,u.last_login_time,u.gender,u.focus_area,u.status as user_status,u.nick FROM user_verify AS uv INNER JOIN user AS u ON uv.uid=u.id ORDER BY uv.created_at DESC',
            'pagination'=>[
            	'pageSize'=>8,
            ], 
        ]);
        // $dataProvider = new ActiveDataProvider(['query'=>UserVerify::find()]);
    	return $this->render('index',[
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = (new \yii\db\Query())->select('user.signature,user.headnode,user.headnode_thumb,user.last_login_time,user.id as uid,user.gender,user.status as user_status,user.nick,user.focus_area,user_verify.*')->from('user')->join('INNER JOIN','user_verify','user_verify.uid=user.id')->where(['user.id'=>$id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionVerify(){
        if(Yii::$app->request->post('button') == 1)
        {
            $user_verify = UserVerify::findOne(['uid'=>Yii::$app->request->post('uid')]);
            $user_verify->status = 1;
            $user_verify->reason = Yii::$app->request->post('reason'); //审核通过理由
            $user_verify->save();
            $user = User::findOne([Yii::$app->request->post('uid')]);
            $user->type = 1;
            $user->nick = $user_verify->name;
            $user->save();
            //TlsHelper::pushMessage3('系统消息','恭喜您，媒体认证成功，查看您的特权。详情页面链接。点击跳转到媒体窝页面。',Yii::$app->request->post('uid'));
        }
        elseif(Yii::$app->request->post('button') == 2){
            $user_verify = UserVerify::findOne(['uid'=>Yii::$app->request->post('uid')]);
            $user_verify->status = 2;
            $user_verify->reason = Yii::$app->request->post('reason'); //审核不通过理由
            $user_verify->save();
            $user = User::findOne([Yii::$app->request->post('uid')]);
            $user->type = 0;
            $user->save();
            //TlsHelper::pushMessage3('系统消息','非常抱歉，您的媒体认证不通过。',Yii::$app->request->post('uid'));
        }

        return $this->redirect(array('view','id'=>Yii::$app->request->post('uid')));
    }

} 
