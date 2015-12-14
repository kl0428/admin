<?php
/**
 * Created by PhpStorm.
 * User: gongxiaohong
 * Date: 15-12-14
 * Time: 上午10:14
 */
class OrderController extends BaseController
{
    public function accessRules()
    {
        return array(

            array('allow',
                'actions'=>array('index','delete'),
                'expression'=>'$user->getState("info")->authority >= 1',
            ),

            array('deny',  // *代表所有的用户
                'users'=>array('*'),
            ),
        );
    }
    public function actionIndex()
    {
        $model = new Order('search');
        $model->unsetAttributes();

        if($_GET['Order'])
            $model->attributes = $_GET['Order'];

       $users = Order::model()->getUser();
        $amount = Order::model()->getAmount();

        $this->render('index',['model'=>$model,'users'=>$users,'amount'=>$amount]);
    }

}