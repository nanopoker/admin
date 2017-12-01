<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helpers\UserHelper;
use common\helpers\DataHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Advice */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Banner管理', 'url' => ['index']];
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
            [
                'attribute'=>'type',
                'value'=> $model->type,
                'format'=>'html'
            ],
            [
                'attribute'=>'img',
                'value'=>'<img src="'.$model->img.'" class="banner2" />',
                'format'=>'html',
            ],
            'link',
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
