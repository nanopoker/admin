<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helpers\UserHelper;
use common\helpers\DataHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Advice */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '意见反馈', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advice-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('编辑', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定要删除吗？',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'content',
            [
                'attribute'=>'uid',
                'value'=>$model->user->username
            ],
            [
                'attribute'=>'status',
                'value'=>DataHelper::getValue(DataHelper::getAdviceStatus(),$model->status),
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
