<?php
/**
 * Created by PhpStorm.
 * User: gongxiaohong
 * Date: 15-10-9
 * Time: 下午3:41
 */
/*默认控制器*/
class IndexController extends Controller{
    /*默认访问方法*/
    public function actionIndex()
    {
        $this->render('index');
    }

}