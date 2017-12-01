<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\widgets;

use Yii;
use yii\base\Widget;

class SideBar extends Widget
{
    public $itemlist;
    
    public function run()
    {
        echo $this->render('sidebar',['itemlist'=>$this->itemlist]);
    }
}
