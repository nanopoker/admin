<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\helpers\UserHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'type',
                'value' => function ($data) {
                    return UserHelper::getUserType($data->type);
                },
            ],
            'username',
            'nick',
            [
                'attribute' => 'headnode',
                'value' => function($data){
                    return '<img class="img-circle img-thumbnail headnode1" src="'.$data->headnode.'" />';
                },
                'format' => 'html'
            ],
            // 'headnode_thumb',
            // 'ext_id',
            // 'ext_type',
            // 'auth_key',
            // 'access_token',
            // 'password_hash',
            // 'password_reset_token',
            // 'email:email',
            // 'cert_level',
            // 'cert_title',
            // 'status',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            // 'updated_at',

            [
                'label'=>'认证',
                'format'=>'raw',
                'value' => function($data){
                    if (is_object($data->verify))
                    {
                        $buttons = '<a class="btn btn-primary waves-effect waves-light" href="'.Url::toRoute(['user/verify','uid'=>$data->id]).'" target="_blank">'.UserHelper::getUserVerifyStatus($data->verify->status).'</a> ';
                    }
                    else 
                    {
                        $buttons = '<a class="btn btn-info disabled">未提交</a> ';
                    }
                
                    return $buttons;
                }
            ],
        ],
    ]); ?>

</div>
