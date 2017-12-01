<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helpers\UserHelper;
use common\helpers\DataHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = '认证信息';
$this->params['breadcrumbs'][] = ['label' => '用户列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $user,
        'attributes' => [
            'id',
            [
                'attribute'=>'type',
                'value'=>UserHelper::getUserType($user->type),
            ],
            'username',
            'nick',
            [
                'attribute'=>'headnode',
                'value'=>'<img src="'.$user->headnode.'" class="img-circle img-thumbnail headnode1" />',
                'format'=>'html',
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d H:i:s']
            ],
        ],
    ]) ?>
    
    <?= DetailView::widget([
        'model' => $verify,
        'attributes' => [
            'name',
            'company',
            'job',
            'phone',
            [
                'attribute'=>'id_front',
                'value'=>'<img src="'.$verify->id_front.'" />',
                'format'=>'html',
            ],
            [
                'attribute'=>'id_back',
                'value'=>'<img src="'.$verify->id_back.'" />',
                'format'=>'html',
            ],
            [
                'attribute'=>'status',
                'value'=>UserHelper::getUserVerifyStatus($verify->status),
            ],
            'reason',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d H:i:s']
            ],
        ],
    ]) ?>
    
    <div class="user-form">

        <?php $form = ActiveForm::begin(); ?>
    
        <?= $form->field($verify, 'status')->dropDownList(DataHelper::getUserVerifyStatus(), ['prompt'=>'-请选择-']) ?>
        
        <?= $form->field($verify, 'reason')->textarea(['maxlength' => true]) ?>
    
        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-success']) ?>
        </div>
    
        <?php ActiveForm::end(); ?>
    
    </div>

</div>
