<?php
/**
 * Created by PhpStorm.
 * User: qing.zhao
 * Date: 15-10-15
 * Time: 上午10:02
 * desc: 人员考核系统--人员管理模块
 */
class StaffController extends BaseController
{
    //人员管理首页
    public function actionIndex()
    {
        /*if($_POST){
            var_dump($_POST);
            exit;
        }*/
        $this->render('index');
    }

    //新增员工
    public function actionCreate()
    {
        $this->render('create');
    }
}