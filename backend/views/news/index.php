<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\helpers\UserHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'news列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('创建news', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'uid',
                'value' => function ($data) {
                    return $data->user->username;
                },
            ],
	    'content',
            'views',
            'comments',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            // 'updated_at',
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
