<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\UserVerify;
use common\models\UserVerifyLog;
use common\helpers\TlsHelper;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find()->with('verify'),
        ]);

        return $this->render('index', [
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionVerify($uid)
    {
        $user = $this->findModel($uid);
        $verify = UserVerify::find()->where(['uid'=>$uid])->one();
        
        if ($verify->load(Yii::$app->request->post())) {
            $verify->save();
            
            if ($verify->status == 1)
            {
                $user->type = 1;
            }
            else
            {
                $user->type = 0;
            }
            
            $user->save();
        } 
        
        return $this->render('verify',['user'=>$user,'verify'=>$verify]);
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
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    //冻结用户
    public function actionFroze($uid){
        $user = User::findOne([Yii::$app->request->get('uid')]);
        $user->status = 11;
        $user->save();
        //TlsHelper::pushMessage3('系统消息','你已被冻结',Yii::$app->request->get('uid'));
        $this->redirect(array('/user-verify/index'));
    }

    //解冻用户
    public function actionUnfroze($uid){
        $user = User::findOne([Yii::$app->request->get('uid')]);
        $user->status = 10;
        $user->save();
        //TlsHelper::pushMessage3('系统消息','您的账号已被解除冻结状态，欢迎回来！',Yii::$app->request->get('uid'));
        $this->redirect(array('/user-verify/index'));
    }

}
