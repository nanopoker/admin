<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\helpers\UserHelper;
use common\helpers\DataHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Banner';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advice-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?= Html::a('创建Banner', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'type',
                'value' => function($data){
                    switch($data->type){
                        case -1:
                        return '网页';
                        break;
                        case 0:
                        return '话题';
                        break;
                        //return $data->type == -1 ? '网页':'观点';
                    }
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'img',
                'value' => function($data){
                    return '<img src="'.$data->img.'" class="banner1" />';
                },
                'format' => 'html'
            ],
            'link',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
