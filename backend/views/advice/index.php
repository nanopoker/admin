<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\helpers\UserHelper;
use common\helpers\DataHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '意见反馈';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advice-index">

    <h1><?= Html::encode($this->title) ?></h1>
	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'content',
            [
                'attribute' => 'uid',
                'value' => function ($data) {
                    return $data->user->username;
                },
            ],
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    return DataHelper::getValue(DataHelper::getAdviceStatus(),$data->status);
                },
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
