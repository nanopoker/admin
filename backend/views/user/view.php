<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helpers\UserHelper;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '用户列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute'=>'type',
                'value'=>UserHelper::getUserType($model->type),
            ],
            'username',
            'nick',
            [
                'attribute'=>'headnode',
                'value'=>'<img src="'.$model->headnode.'" class="img-circle img-thumbnail headnode1" />',
                'format'=>'html',
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d H:i:s']
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:Y-m-d H:i:s']
            ],
        ],
    ]) ?>

</div>
