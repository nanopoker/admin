<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helpers\UserHelper;
use common\helpers\DataHelper;

/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'news列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('编辑', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定要删除吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'content',
            [
                'attribute'=>'uid',
                'value'=>$model->user->username
            ],
            /*[
                'attribute'=>'status',
                'value'=>DataHelper::getValue(DataHelper::getNewsStatus(),$model->status),
            ],*/
            'views',
            'comments',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d H:i:s']
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:Y-m-d H:i:s']
            ],
            /*[
                'label'=>'图片',
                'value'=>DataHelper::getNewsImageHtml($model->newsImage),
                'format'=>'html'
            ],*/
        ],
    ]) ?>

</div>
