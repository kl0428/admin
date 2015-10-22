<?php
/**
 * Created by PhpStorm.
 * User: geminiblue
 * Date: 14-3-31
 * Time: 下午3:49
 */
class SlideMenu extends CWidget
{
    private $menu_map;

    public function run()
    {
        $this->menu_map = Yii::app()->params['slide_menu'];
        $this->renderFile(dirname(__FILE__).'/views/slide_menu.php');
    }
}