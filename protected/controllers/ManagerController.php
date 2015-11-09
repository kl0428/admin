<?php
/**
 * Created by PhpStorm.
 * User: gongxiaohong
 * Date: 15-11-9
 * Time: 下午3:25
 */
class ManagerController extends BaseController
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
        /*public function filters()
        {
            return [
                [
                    'application.components.AccessFilter  -doOpenBox'
                ]
            ];
        }*/
        /**
         * Specifies the access control rules.
         * This method is used by the 'accessControl' filter.
         * @return array access control rules
         */
        public function accessRules()
        {
            return array(
                array('allow', // @代表有角色的
                    'actions'=>array('index','change'),
                    'users'=>array('@'),
                ),
                array('allow', // allow admin user to perform 'admin' and 'delete' actions
                    'actions'=>array('create','update','quit'),
                    'expression'=>'$user->getState("info")->authority >= 1',//,array($this,"isSuperUser"),
                ),
                array('deny',  // *代表所有的用户
                    'users'=>array('*'),
                ),
            );
        }
        //人员管理首页
        public function actionIndex()
        {
            $model = new Managers('search');
            $model->unsetAttributes();
            $names = Managers::model()->loadStaffAllModel();

            if (isset($_GET['Managers']))
                $model->attributes = $_GET['Managers'];
            $this->render('index',['model'=>$model,'names'=>$names]);
        }

    //新增员工
    public function actionCreate()
    {
        $model = new Managers();
        if($_POST['Managers']){
            $model->attributes = $_POST['Managers'];
            if($model->validate())
            {
                $model->setAttribute('password',md5($_POST['Managers']['name'].md5($_POST['Managers']['password'])));
                if($model->save()){
                    Yii::app()->user->setFlash('setStaff','添加成功');
                    // $this->refresh();
                    $this->redirect(array('manager/index'));
                }

            }
        }
        $this->render('create',['model'=>$model]);
    }

    public function actionUpdate()
    {
        $id = Yii::app()->request->getParam( 'id' );
        if(intval($id)) {
            $model = new Managers();

            $staff = Managers::model()->findByPk($id);
            if ($_POST['Managers']) {
                $userinfo = $_POST['Managers'];

                if($userinfo['password']&& $userinfo['name']){
                    $userinfo['password']=  md5($userinfo['name'] . md5($userinfo['password']));

                }else{
                    unset($userinfo['password']);
                }
                if (Managers::model()->updateByPk($id,$userinfo)) {
                    Yii::app()->user->setFlash('setStaff', '修改成功');
                    $this->redirect(array('manager/index'));
                }


            }
            if($staff){
                $model = $staff;
                $model->setAttribute('password','');
            }else{
                $model = new Managers("create");
            }
            $this->render('create', ['model' => $model]);
        }else{
            $this->redirect(array('manager/index'));
        }
    }

    public function actionQuit()
    {
        $id = $this->_get('id');
        if(intval($id)){
            $model = Managers::model()->findByPk($id);
            $model->setAttribute('is_quit',1);
            if($model->save()){
                Yii::app()->user->setFlash('setStaff', '退出成功');
                // $this->refresh();
                $this->redirect(array('manager/index'));
            }
        }else{
            Yii::app()->user->setFlash('setStaff', '退出失败');
            $this->redirect(array('manager/index'));
        }
    }

    public function actionDelete()
    {
        $id = $this->_get('id');
        if(intval($id)){
            if(Managers::model()->deleteByPk($id)){
                Yii::app()->user->setFlash('setStaff', '删除成功');
                // $this->refresh();
                $this->redirect(array('manager/index'));
            }
        }else{
            Yii::app()->user->setFlash('setStaff', '删除失败');
            $this->redirect(array('manager/index'));
        }
    }

    public function actionChange($id)
    {

        $model = new ChangeForm();
        if($_POST['ChangeForm']){
            $model->setAttributes($_POST['ChangeForm']);
            if($model->validate() && $model->checkPwd($id,$_POST['ChangeForm']['old_pwd'])){
                $userinfo = Managers::model()->findByPk($id);
                $new_password = md5($userinfo->name.md5($_POST['ChangeForm']['sure_pwd']));
                if(Managers::model()->updateByPk($id,['password'=>$new_password])){
                    Yii::app()->user->logout();
                    Yii::app()->session->destroy();
                    $this->redirect(Yii::app()->user->loginUrl);
                }
            }
        }
        $info =  Managers::model()->loadStaffModel($id);
        $this->render('change',['model'=>$model,'info'=>$info]);

    }

}