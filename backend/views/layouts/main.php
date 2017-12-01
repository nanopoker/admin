<?php 
use yii\helpers\Html;
use backend\widgets\SideBar;
use yii\helpers\Url;
use backend\widgets\AdminBreadcrumbs;
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

        <link href="<?php echo Yii::getAlias('@web')?>/admin/plugins/switchery/switchery.min.css" rel="stylesheet" />
        <link href="<?php echo Yii::getAlias('@web')?>/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo Yii::getAlias('@web')?>/admin/css/core.css" rel="stylesheet" type="text/css">
        <link href="<?php echo Yii::getAlias('@web')?>/admin/css/icons.css" rel="stylesheet" type="text/css">
        <link href="<?php echo Yii::getAlias('@web')?>/admin/css/components.css" rel="stylesheet" type="text/css">
        <link href="<?php echo Yii::getAlias('@web')?>/admin/css/pages.css" rel="stylesheet" type="text/css">
        <link href="<?php echo Yii::getAlias('@web')?>/admin/css/menu.css" rel="stylesheet" type="text/css">
        <link href="<?php echo Yii::getAlias('@web')?>/admin/css/responsive.css" rel="stylesheet" type="text/css">
        
        <link href="<?php echo Yii::getAlias('@web')?>/css/customer.css" rel="stylesheet" type="text/css">

        <script src="<?php echo Yii::getAlias('@web')?>/admin/js/modernizr.min.js"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <?php $this->head() ?>
    </head>


    <body class="fixed-left">
        <?php $this->beginBody() ?>
        <!-- Begin page -->
        <div id="wrapper">
        
            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="<?php echo Url::toRoute(['site/index'])?>" class="logo"><i class="md md-equalizer"></i> <span>内容管理</span> </a>
                    </div>
                </div>

                <!-- Navbar -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left waves-effect">
                                    <i class="md md-menu"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>

                            

                            
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            <?php
            $today_counts = [
                'point'=>0,
                'news'=>0,
                'redflower'=>0,
                'webview'=>0,
                'user'=>0,
                'report'=>0,
                'advice'=>0,
                'reportervip'=>0,
                'user_verify'=>0,
                'focus_area'=>0,
                'version'=>0,
            ];
            $itemlist = [
                /* ['icon'=>'ti-gift','name' => '广告管理','controllers'=>['moka-product'], 'sub' => [
                    ['name' => '新建商品', 'url' => Url::toRoute(['/moka-product/create']),'controller'=>'moka-product','action'=>'create'],
                    ['name' => '商品列表', 'url' => Url::toRoute(['/moka-product/index']),'controller'=>'moka-product','action'=>'index'],
                ]], */
                //['icon'=>'ti-target','name' => '观点管理','url' => Url::toRoute(['/point/index']),'num'=>$today_counts['point'],'count-class'=>'label-primary','controllers'=>['point']],
                ['icon'=>'ti-bolt','name' => 'news','url' => Url::toRoute(['/news/index']),'num'=>$today_counts['news'],'count-class'=>'label-warning','controllers'=>['news']],
                /*['icon'=>'ti-bolt','name' => '小红花管理','url' => Url::toRoute(['/redflower/index']),'num'=>$today_counts['redflower'],'count-class'=>'label-warning','controllers'=>['redflower']],
                ['icon'=>'ti-tag','name' => 'Webview配置','url' => Url::toRoute(['/webview/index']),'controllers'=>['webview']],
                ['icon'=>'ti-tag','name' => '频道管理','url' => Url::toRoute(['/channel/index']),'controllers'=>['channel']],*/
                ['icon'=>'ti-image','name' => '广告位图片','url' => Url::toRoute(['/banner/index']),'controllers'=>['banner']],
                /*['icon'=>'ti-image','name' => '媒体窝banner管理','url' => Url::toRoute(['/reportervip/index']),'controllers'=>['reportervip']],
                ['icon'=>'ti-alert','name' => '举报管理','url' => Url::toRoute(['/report/index']),'num'=>$today_counts['report'],'count-class'=>'label-danger','controllers'=>['report']],*/
                ['icon'=>'ti-comment-alt','name' => '意见反馈','url' => Url::toRoute(['/advice/index']),'num'=>$today_counts['advice'],'count-class'=>'label-success','controllers'=>['advice']],
                // ['icon'=>'ti-user','name' => '用户管理','url' => Url::toRoute(['/user/index']),'num'=>$today_counts['user'],'count-class'=>'label-success','controllers'=>['user']],
                ['icon'=>'ti-user','name' => '用户审核','url' => Url::toRoute(['/user-verify/index']),'num'=>$today_counts['user_verify'],'count-class'=>'label-success','controllers'=>['user-verify']],
                //['icon'=>'ti-user','name' => '专注领域管理','url' => Url::toRoute(['/focusarea/index']),'num'=>$today_counts['focus_area'],'count-class'=>'label-success','controllers'=>['focusarea']],
                //['icon'=>'ti-user','name' => '内测版本链接','url' => Url::toRoute(['/version/index']),'num'=>$today_counts['version'],'count-class'=>'label-success','controllers'=>['version']],
                //['icon'=>'ti-bar-chart-alt','name' => '数据统计', 'url' => Url::toRoute(['/statistics/index']),'controllers'=>['statistics']],
            ];
            
            echo SideBar::widget([
                'itemlist'=>$itemlist
            ]);
            ?>
            
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->                      
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <?= AdminBreadcrumbs::widget([
                                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                    ]) ?>
                                    <h4 class="page-title"><?= Html::encode($this->title) ?></h4>
                                </div>
                            </div>
                        </div>

                        <?= $content ?>

                    </div>
                    <!-- end container -->

                </div>
                <!-- end content -->



                <!-- FOOTER -->
                <footer class="footer text-right">
                    nanopoker © 内容管理.
                </footer>
                <!-- End FOOTER -->

            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->


    
        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
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
        <script src="<?php echo Yii::getAlias('@web')?>/admin/plugins/switchery/switchery.min.js"></script>

        <script src="<?php echo Yii::getAlias('@web')?>/admin/js/jquery.core.js"></script>
        <script src="<?php echo Yii::getAlias('@web')?>/admin/js/jquery.app.js"></script>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
