<?php
/**
 * Created by PhpStorm.
 * User: gongxiaohong
 * Date: 15-11-23
 * Time: 下午2:03
 */
class ReportController extends BaseController
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
        $model = new Report('search');
        $model->unsetAttributes();

        if($_GET['Report'])
            $model->attributes = $_GET['Report'];

        list($users,$report) = Report::model()->getUser();
        $this->render('index',['model'=>$model,'users'=>$users,'report'=>$report]);
    }

    public function actionDelete()
    {
        $id = $this->_get('id');
        $user_id = $this->_get('user_id');
        $obj = User::model()->findByPk($user_id);
        if($id && Report::model()->deleteByPk($id)){
            $mobile = $obj->mobile;
            if(isset($mobile)&&$mobile){// $type =='register','forget',
                $sms = new Sms();
                $result = $sms->sendSMS($mobile, '您好，你的反馈我们已近收到,我们将尽快处理,Urtime谢谢你的宝贵意见','true');
                $result = $sms->execResult($result);
                if($result[1]==0){
                    // echo '发送成功';
                    Yii::app()->user->setFlash('send',1);
                    $this->redirect(array('report/index'));

                }else{
                    //echo "发送失败{$result[1]}";
                    Yii::app()->user->setFlash('send',0);
                    $this->redirect(array('report/index'));
                }
            }else{
                Yii::app()->user->setFlash('report',0);
                $this->redirect(array('report/index'));
            }

        }else{
            Yii::app()->user->setFlash('report',0);
            $this->redirect(array('report/index'));
        }
    }
}