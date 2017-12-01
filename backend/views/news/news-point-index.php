<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\helpers\UserHelper;
use common\models\NewsPoint;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '快讯观点列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <h3>快讯：<?= Html::encode($news->content) ?></h3>

    <p>
        <?= Html::a('添加观点', ['point/index','newsid'=>$newsid], ['class' => 'btn btn-success']) ?>
        <?= Html::a('返回', ['news/index'], ['class' => 'btn btn-primary']) ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'pointid',
                'value' => function ($data) {
                    return $data->point->title;
                },
            ],

            [
                'label'=>'操作',
                'format'=>'raw',
                'value' => function($data){
                    $buttons = '<a class="btn btn-danger waves-effect waves-light" href="'.Url::toRoute(['news/news-point-delete','id'=>$data->id]).'" target="_blank">删除</a> ';
                
                    return $buttons;
                }
            ],
        ],
    ]); ?>

</div>
