<?php
/**
 * Created by PhpStorm.
 * User: qing.zhao
 * Date: 15-10-15
 * Time: 上午11:57
 * DESC:人事考核系统--部门管理模块
 */
class UnitController extends BaseController
{
    //视图
    public function actionIndex()
    {
        $this->render('index');
    }
}