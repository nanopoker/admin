<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\helpers\UserHelper;
use common\helpers\DataHelper;
use yii\helpers\Url;

?>
<div class="advice-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute'=>'姓名','value'=>function($data){return $data['name'];}],
            ['attribute'=>'用户昵称','value'=>function($data){return $data['nick'];}],
            ['attribute'=>'性别','value'=>function($data){return UserHelper::getUserGender($data['gender']);}],
            ['attribute'=>'电话','value'=>function($data){return $data['phone'];}],
            ['attribute'=>'邮箱','value'=>function($data){return $data['email'];}],
            ['attribute'=>'所在公司','value'=>function($data){return $data['company'];}],
            ['attribute'=>'职务','value'=>function($data){return $data['job'];}],
            ['attribute'=>'专注领域','value'=>function($data){return $data['focus_area'];}],
            ['attribute'=>'申请认证时间','value'=>function($data){return date('Y-m-d H:i:s',$data['created_at']);}],
            ['attribute'=>'最近登录时间','value'=>function($data){return date('Y-m-d H:i:s',$data['last_login_time']);}],
            ['attribute'=>'用户身份','value'=>function($data){
                switch($data['status']){
                    case 0:return '认证中';break;
                    case 1:return '认证通过';break;
                    case 2:return '认证失败';break;
                }
                return $data['status'];}],
            ['attribute'=>'用户状态','value'=>function($data){
                switch($data['user_status']){
                    case 10:return '正常';break;
                    case 11:return '冻结用户';break;
                }
                return $data['user_status'];}],
            [
                'label'=>'操作',
                'format'=>'raw',
                'value' => function($data){
                    if ($data['user_status']==10 && $data['status']==0)
                    {
                        return '<a href="'.Url::toRoute(['user-verify/view','id'=>$data['uid']]).'" target="_blank">'.'审&nbsp;&nbsp核'.'</a></br>'.'<a href="'.Url::toRoute(['user/froze','uid'=>$data['uid']]).'"">'.'冻&nbsp;&nbsp结'.'</a>';
                    }
                    elseif ($data['user_status']==10 && $data['status']==1)
                    {
                        return '<a href="'.Url::toRoute(['user-verify/view','id'=>$data['uid']]).'" target="_blank">'.'详&nbsp;&nbsp情'.'</a></br>'.'<a href="'.Url::toRoute(['user/froze','uid'=>$data['uid']]).'"">'.'冻&nbsp;&nbsp结'.'</a>';
                    }
                    elseif ($data['user_status']==10 && $data['status']==2)
                    {
                        return '<a href="'.Url::toRoute(['user-verify/view','id'=>$data['uid']]).'" target="_blank">'.'详&nbsp;&nbsp情'.'</a></br>'.'<a href="'.Url::toRoute(['user/froze','uid'=>$data['uid']]).'"">'.'冻&nbsp;&nbsp结'.'</a>';
                    }
                    elseif ($data['user_status']==11 && $data['status'] == 0)
                    {
                        return '<a href="'.Url::toRoute(['user-verify/view','id'=>$data['uid']]).'" target="_blank">'.'审&nbsp;&nbsp核'.'</a></br>'.'<a href="'.Url::toRoute(['user/unfroze','uid'=>$data['uid']]).'"">'.'解&nbsp;&nbsp冻'.'</a>';
                    }
                    elseif ($data['user_status']==11 && $data['status']==1)
                    {
                        return '<a href="'.Url::toRoute(['user-verify/view','id'=>$data['uid']]).'" target="_blank">'.'详&nbsp;&nbsp情'.'</a></br>'.'<a href="'.Url::toRoute(['user/unfroze','uid'=>$data['uid']]).'"">'.'解&nbsp;&nbsp冻'.'</a>';
                    }
                    elseif ($data['user_status']==11 && $data['status']==2)
                    {
                        return '<a href="'.Url::toRoute(['user-verify/view','id'=>$data['uid']]).'" target="_blank">'.'详&nbsp;&nbsp情'.'</a></br>'.'<a href="'.Url::toRoute(['user/unfroze','uid'=>$data['uid']]).'"">'.'解&nbsp;&nbsp冻'.'</a>';
                    }
                }],
        ],
    ]); ?>

</div>

<script>
$(function(){
	alert(1);
});
</script>
