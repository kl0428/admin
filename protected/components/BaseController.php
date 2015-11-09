<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
Yii::import('application.components.Snoopy');
class BaseController extends Controller
{
    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $_http;
    public $boxTitle;
    public $layout='//layouts/main';
    public $breadcrumbs=array();
    public $menu = array();
    public $themePath='';
    public function init()
    {
        $this->themePath = Yii::app()->theme->baseUrl."/static/";
        Yii::app()->clientScript->registerCoreScript("jquery");
        Yii::app()->clientScript->registerCoreScript("jquery.ui");
        Yii::app()->clientScript->scriptMap = array(
            'scoket.io'=>array(
                'js'=>array(YII_DEBUG ? 'jquery.js' : 'jquery.min.js'),
            ),
        );
        Yii::app()->assetManager->publish("js/socket.io.js",true, 2,true);
	    Yii::app()->clientScript->registerScriptFile("/js/public.js",CClientScript::POS_HEAD);
        parent::init();
    }
    /*public function onUnauthorizedAccess()
    {
        throw new CHttpException(403);
    }*/
   /* public function filters()
    {
        return array(
            'rights - login - error',
        );
    }*/

    public function _get($name,$default = ''){
        return trim(Yii::app()->request->getParam($name,$default));
    }

    public function _post($name,$default = ''){
        return trim(Yii::app()->request->getPost($name,$default));
    }

    public function _isAjaxRequest(){
        return Yii::app()->request->isAjaxRequest;
    }
    public function _isPost(){
        return Yii::app()->request->isPostRequest;
    }
    /**
     * 格式化打印数组
     */
    public function dump($data){
        echo '<pre>';print_r($data);echo '</pre>';
    }
    /**
     * 简化findall数据
     * */
    function simplifyData($data){
        foreach($data as $key=>$val){
            $newData[$key] = $val->attributes;
        }
        return $newData;
    }

    /**
     * @return array 过滤器列表，会顺序执行
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }
}