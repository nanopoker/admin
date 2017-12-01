<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '登录';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <meta name="description" content="内容管理">
        <meta name="author" content="dick">

        <link rel="shortcut icon" href="<?php echo Yii::getAlias('@web')?>/admin/images/favicon_1.ico">

        <title><?= Html::encode($this->title) ?></title>

        <link href="<?php echo Yii::getAlias('@web')?>/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo Yii::getAlias('@web')?>/admin/css/core.css" rel="stylesheet" type="text/css">
        <link href="<?php echo Yii::getAlias('@web')?>/admin/css/icons.css" rel="stylesheet" type="text/css">
        <link href="<?php echo Yii::getAlias('@web')?>/admin/css/components.css" rel="stylesheet" type="text/css">
        <link href="<?php echo Yii::getAlias('@web')?>/admin/css/pages.css" rel="stylesheet" type="text/css">
        <link href="<?php echo Yii::getAlias('@web')?>/admin/css/menu.css" rel="stylesheet" type="text/css">
        <link href="<?php echo Yii::getAlias('@web')?>/admin/css/responsive.css" rel="stylesheet" type="text/css">

        <script src="<?php echo Yii::getAlias('@web')?>/admin/js/modernizr.min.js"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrapper-page">

            <div class="text-center">
                <a href="index.html" class="logo logo-lg"><i class="md md-equalizer"></i> <span>管理后台</span> </a>
            </div>

            <?php $form = ActiveForm::begin(['id' => 'login-form','options'=>['class'=>'form-horizontal m-t-20']]); ?>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" required="" placeholder="用户名" name="LoginForm[username]">
                        <i class="md md-account-circle form-control-feedback l-h-34"></i>
                        <?php if ($model->hasErrors('username')){?>
                        <p class="text-danger"><?php echo $model->getErrors('username')[0];?></p>
                        <?php }?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" required="" placeholder="密码" name="LoginForm[password]">
                        <i class="md md-vpn-key form-control-feedback l-h-34"></i>
                        <?php if ($model->hasErrors('password')){?>
                        <p class="text-danger"><?php echo $model->getErrors('password')[0];?></p>
                        <?php }?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="checkbox checkbox-primary">
                            <input id="checkbox-signup" type="checkbox" name="LoginForm[rememberMe]">
                            <label for="checkbox-signup"> 记住我</label>
                        </div>

                    </div>
                </div>

                <div class="form-group text-right m-t-20">
		    <div class="col-xs-12">
                        <button class="btn btn-primary btn-custom w-md waves-effect waves-light" type="submit">登录
                        </button>
                    </div>
                </div>
            <?php ActiveForm::end(); ?>
        </div>

        
    	<script>
            var resizefunc = [];
        </script>

        <!-- Main  -->
        <script src="<?php echo Yii::getAlias('@web')?>/admin/js/jquery.min.js"></script>
        <script src="<?php echo Yii::getAlias('@web')?>/admin/js/bootstrap.min.js"></script>
        <script src="<?php echo Yii::getAlias('@web')?>/admin/js/detect.js"></script>
        <script src="<?php echo Yii::getAlias('@web')?>/admin/js/fastclick.js"></script>
        <script src="<?php echo Yii::getAlias('@web')?>/admin/js/jquery.slimscroll.js"></script>
        <script src="<?php echo Yii::getAlias('@web')?>/admin/js/jquery.blockUI.js"></script>
        <script src="<?php echo Yii::getAlias('@web')?>/admin/js/waves.js"></script>
        <script src="<?php echo Yii::getAlias('@web')?>/admin/js/wow.min.js"></script>
        <script src="<?php echo Yii::getAlias('@web')?>/admin/js/jquery.nicescroll.js"></script>
        <script src="<?php echo Yii::getAlias('@web')?>/admin/js/jquery.scrollTo.min.js"></script>

        <!-- Custom main Js -->
        <script src="<?php echo Yii::getAlias('@web')?>/admin/js/jquery.core.js"></script>
        <script src="<?php echo Yii::getAlias('@web')?>/admin/js/jquery.app.js"></script>
	
	   <?php $this->endBody() ?>
	</body>
<script>
 $(function(){
		$('#sign-in').click(function(){
			window.open("https://www.baidu.com/");
		});
	});
</script>

</html>
<?php $this->endPage() ?>
