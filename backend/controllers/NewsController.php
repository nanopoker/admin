<?php

namespace backend\controllers;

use Yii;
use common\models\News;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Object;
use common\models\NewsImage;
use common\models\AdminUser;
use yii\base\Model;
use yii\helpers\Url;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post', 'get'],
                ],
            ],
        ];
    }

    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => News::find()->with('user')->orderBy('created_at DESC'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
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
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
	Yii::warning("this is a warning");
        $model = new News();
        $newsImage = [new NewsImage()];

        if ($model->load(Yii::$app->request->post())) {
	    Yii::error("this is error1");
	    Yii::error(Yii::$app->request->post());
	    Yii::error($model->uid);
		
		Yii::error(Yii::$app->session->get('uid'));
	

            $model->uid = Yii::$app->session->get('uid');
            
            if (mb_strlen($model->content,'utf-8') > 200)
            {
                $model->addError('content','字数不能超过200个');
            }
            
            if (count($model->errors)==0 && $model->save())
            {
		Yii::error("this is the error source");
                if (isset($_POST['NewsImage'])) {
                    $newsImageCount = count($_POST['NewsImage']);
                    $newsImage = [];
                    for ($i = 0; $i < $newsImageCount; $i++) {
                        $newsImage[] = new NewsImage();
                    }
            
                    if (Model::loadMultiple($newsImage, Yii::$app->request->post())) {
                        foreach ($newsImage as $key=>$n_i) {
                            $n_i->newsid = $model->id;
                            $n_i->save();
                        }
                    }
            
                }
            
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else
            {
		Yii::error("this is error2");
                print_r($model->errors);
            }
        } else {
		Yii::error("this is error3");
            return $this->render('create', [
                'model' => $model,
                'newsImage'=>$newsImage
            ]);
        }
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $newsImage = NewsImage::find()->where(['newsid'=>$id])->all();

        if ($model->load(Yii::$app->request->post())) {
            $model->uid = Yii::$app->session->get('uid');
            
            if (mb_strlen($model->content,'utf-8') > 200)
            {
                $model->addError('content','字数不能超过200个');
            }
            
            if (count($model->errors)==0 && $model->save())
            {
                if (isset($_POST['NewsImage'])) {
                    $newsImageCount = count($_POST['NewsImage']);
                
                    echo "NewsImageCount is " . $newsImageCount . "<br />";
                
                    //return;
                    $newsImage = [];
                    for ($i = 0; $i < $newsImageCount; $i++) {
                        $newsImage[] = new NewsImage();
                    }
                
                    if (Model::loadMultiple($newsImage, Yii::$app->request->post())) {
                
                        $images = '';
                        //保存商品图片
                        foreach ($newsImage as $key=>$n_i) {
                            if (!empty($n_i->id) && $n_i->id > 0) {
                                $oldNewsImage = NewsImage::findOne($n_i->id);
                
                                if (is_object($oldNewsImage)) {
                                    $oldNewsImage->image = $n_i->image;
                                    $oldNewsImage->image_thumb = $n_i->image_thumb;
                                    $oldNewsImage->save();
                                }
                                else {
                                    $n_i->newsid = $model->id;
                                    $n_i->save();
                                }
                            } else {
                                $n_i->newsid = $model->id;
                                $n_i->save();
                            }
                        }
                    }
                
                }
                
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'newsImage' => $newsImage,
            ]);
        }
    }
    
    public function actionDeleteImage()
    {
        if (isset($_POST['id'])) {
            $id = intval($_POST['id']);
            $model = NewsImage::findOne($id);
            if (is_object($model)) {
                unlink(Yii::getAlias('@webroot').$model->image);
                unlink(Yii::getAlias('@webroot').$model->image_thumb);
                $model->delete();
            }
        }
    
        return json_encode(['code' => 0]);
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        
        $news_image = NewsImage::find()->where(['newsid'=>$id])->all();
        foreach ($news_image as $n_i)
        {
            unlink(Yii::getAlias('@webroot').$n_i->image);
            unlink(Yii::getAlias('@webroot').$n_i->image_thumb);
            $n_i->delete();
        }

        return $this->redirect(['index']);
    }
    
    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
