<?php
/**
 * Created by PhpStorm.
 * User: gongxiaohong
 * Date: 15-11-20
 * Time: 上午11:15
 */

class UserController extends BaseController
{

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(

            array('allow',
                'actions'=>array('index','update'),
                'expression'=>'$user->getState("info")->authority >= 1',
            ),

            array('deny',  // *代表所有的用户
                'users'=>array('*'),
            ),
        );
    }
    public function actionIndex()
    {
        $model = new User('search');
        $model->unsetAttributes();
        list($names,$times,$mobiles) = User::model()->loadStaffAllModel();
       /* var_dump($names);
        var_dump($times);
        var_dump($mobiles);
        exit;*/
        if($_GET['User'])
         $model->attributes = $_GET['User'];

        $this->render('index',['model'=>$model,'names'=>$names,'times'=>$times,'mobiles'=>$mobiles]);
    }

    public function actionUpdate()
    {
        $id = Yii::app()->request->getParam( 'id' );
        if(intval($id)) {
            $model = User::model()->findByPk($id);

            if ($_POST['User']) {
                $userinfo = $_POST['User'];
                if($userinfo['password']&& $userinfo['nickname']){
                    $userinfo['password']=  md5($userinfo['naickname'] . md5($userinfo['password']));
                }else{
                    unset($userinfo['password']);
                }

                if(!$userinfo['province'])
                {
                    unset($userinfo['province']);
                }
                if(!$userinfo['city'])
                {
                    unset($userinfo['city']);
                }
                $model->attributes = $userinfo;
                //if (ExaminationUserInfo::model()->updateByPk($id,$userinfo)) {
                if ($model->validate()&&$model->save()) {
                    Yii::app()->user->setFlash('setStaff', '修改成功');
                    $this->redirect(array('user/index'));
                }


            }
            if($model){
                $model->setAttribute('password','');
            }else{
                $model = new User("create");
            }
            $province = YhmCity::model()->province();
            $this->render('update', ['model' => $model,'province'=>$province]);
        }else{
            $this->redirect(array('user/index'));
        }
    }
}