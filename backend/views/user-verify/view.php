<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helpers\UserHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */

?>
<div class="user-view">
	<h1>用户详情</h1>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
        	[
                'attribute'=>'headnode',
                'label'=>'用户头像',
                'value'=>'<img src="'.$model['headnode_thumb'].'" class="img-circle img-thumbnail headnode1" />',
                'format'=>'html',
            ],
            ['attribute'=>'name','label'=>'真实姓名'],
            ['attribute'=>'gender','label'=>'性别','value'=>UserHelper::getUserGender($model['gender'])],
            ['attribute'=>'nick','label'=>'用户昵称',],
            ['attribute'=>'email','label'=>'用户邮箱'],
            [
                'attribute'=>'type',
                'label'=>'用户状态',
                'value'=>UserHelper::getUserVerifyStatus($model['status']),
            ],
            ['attribute'=>'phone','label'=>'用户手机'],
            ['attribute'=>'company','label'=>'用户公司'],
            ['attribute'=>'job','label'=>'用户职务'],
            ['attribute'=>'focus_area','label'=>'专注领域'],
            ['attribute'=>'signature','label'=>'个性签名'],
            ['attribute'=>'status','label'=>'用户身份','value'=>UserHelper::getUserVerifyStatus($model['status'])],
            ['attribute'=>'user_status','label'=>'用户状态','value'=>UserHelper::getUserStatus($model['user_status'])],
        ],
    ]) ?>
    <?php if($model['status']==0 || $model['status']==2){?>
	    <p>审核意见</p>
	    <form id='审核意见' action='/index.php?r=user-verify%2Fverify' method='post' >
		    <textarea name='reason' cols=115 rows=5 maxlength=1000><?=$model['reason']?></textarea>
		    <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
		    <input type='hidden' name='uid' value="<?=$model['uid'] ?>" />
		    </br>
		    <button type='submit' value=1 name='button'>审核通过</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		    <button type='submit' value=2 name='button'>审核不通过</button>
	    </form>
	<?php }elseif($model['status'] == 1){?>
		<p>审核意见：<?=$model['reason']?></p>
	<?php }?>
</div>
