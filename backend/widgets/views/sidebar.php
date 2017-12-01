<?php
use yii\helpers\Url;
?>
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">

                    <div id="sidebar-menu">
                        <ul>
                            <li class="text-muted menu-title">导航</li>
                            <?php foreach ($itemlist as $item) {?>
                            <li class="<?php if (isset($item['sub'])) {echo 'has_sub';}?>">
                                <a href="<?php if (isset($item['url'])) echo $item['url'];else echo '#'?>" class="waves-effect waves-primary
                                <?php 
                                    if (!isset($item['action'])) {
                                        if (in_array(Yii::$app->controller->id, $item['controllers']))echo ' active';
                                    }
                                    else 
                                    {
                                        if (in_array(Yii::$app->controller->id, $item['controllers']) && Yii::$app->controller->action->id==$item['action'])echo ' active';
                                    }
                                ?>
                                ">
                                    <i class="<?php echo $item['icon']?>"></i> 
                                    <?php if (isset($item['num']) && $item['num'] > 0) {?>
                                        <span class="label <?php echo $item['count-class']?> pull-right"><?php echo $item['num']?></span>
                                    <?php }?>
                                    <span> <?php echo $item['name']?> </span> 
                                </a>
                                <?php if (isset($item['sub'])) {?>
                                <ul class="list-unstyled">
                                    <?php foreach ($item['sub'] as $subitem) {?>
                                    <li class="<?php if (Yii::$app->controller->id==$subitem['controller'] && Yii::$app->controller->action->id==$subitem['action'])echo 'active'?>">
                                        <a href="<?php echo $subitem['url'];?>"><?php echo $subitem['name']?></a>
                                    </li>
                                    <?php }?>
                                </ul>
                                <?php }?>
                            </li>
                            <?php }?>
                        </ul>
                        <div class="clearfix"></div>
                    </div>


                    <div class="clearfix"></div>
                </div>
                
                <div class="user-detail">
                    <div class="dropup">
                        <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"><img
                                src="<?php echo Yii::getAlias('@web')?>/admin/images/users/avatar-2.jpg" alt="user-img" class="img-circle"> </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo Url::toRoute(['site/logout'])?>"><i class="md md-settings-power"></i> Logout</a></li>
                        </ul>
                    </div>

                    <h5 class="m-t-0 m-b-0"><?php echo Yii::$app->session->get('username');?></h5>
                    <p class="text-muted m-b-0">
                        <small><i class="fa fa-circle text-success"></i> <span>Online</span></small>
                    </p>
                </div>
            </div>