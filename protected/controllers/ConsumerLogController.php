<?php
/**
 * Created by PhpStorm.
 * User: gongxiaohong
 * Date: 15-12-14
 * Time: 下午1:22
 */
class ConsumerLogController extends BaseController
{
    public function actionCreate()
    {
        $model  = new ConsumerLog();
        $model->unsetAttributes();

        if($_POST['ConsumerLog'])
        {
            $model->attributes = $_POST['ConsumerLog'];
            if($model->validate()){
                $model->setAttribute('fee',$model->price/$model->total);
                if($model->save()&& Card::model()->updateByPk($model->card_id,['used_num'=>$model->used+1])){
                    Yii::app()->user->setFlash('ConsumerLog','提交成功');
                }
            }

        }
        $stores = Store::model()->getName();
        $this->render('create',['model'=>$model,'stores'=>$stores]);
    }

    public function actionIndex()
    {
        $model = new ConsumerLog('search');
        $model->unsetAttributes();
        $amount = ConsumerLog::model()->getAmount();
        if($_GET['ConsumerLog']){
            $model->attributes = $_GET['ConsumerLog'];
            /* var_dump($_GET);
            exit;*/
            $amount = ConsumerLog::model()->getAmount($_GET['ConsumerLog']);
        }


        $names = Store::model()->getName();


        $this->render('index',['model'=>$model,'names'=>$names,'amount'=>$amount]);
    }
}