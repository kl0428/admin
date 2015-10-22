<?php
/**
 * Created by PhpStorm.
 * User: qing.zhao
 * Date: 15-10-15
 * Time: 下午3:53
 * Desc:人事考核系统--考核模块
 */
class CheckController extends BaseController
{
    public function init()
    {
        parent::init();
        $clientScript = Yii::app()->clientScript;
        $clientScript->registerScriptFile("/js/bootstrapValidator.min.js", CClientScript::POS_BEGIN);
        $clientScript->registerCssFile("/css/bootstrapValidator.min.css", CClientScript::POS_BEGIN);
        //$this->info = Yii::app()->user->getState('info');
        //$this->layout = '//layouts/main2';
    }
    public function actionIndex()
    {
        $this->render('index');
    }
}