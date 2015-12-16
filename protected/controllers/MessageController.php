<?php
/**
 * Created by PhpStorm.
 * User: gongxiaohong
 * Date: 15-12-16
 * Time: 下午2:26
 */
class MessageController extends BaseController
{
    public function actionCreate()
    {
        $model = new Message();
        if($_POST['Message']){
            $model->attributes=$_POST['Message'];
            if($model->validate() && $model->save()){
                Yii::app()->user->setFlash('Message','创建成功');
                $this->redirect(array('message/index'));
            }else{
                var_dump($model->getErrors());
            }
        }

        $this->render('create',array('model'=>$model));
    }

    public function actionIndex()
    {
        $model = new Message('search');
        $this->render('index',['model'=>$model]);
    }

    public function actionUpdate()
    {
        $id = $this->_get('id');
        if($id && Message::model()->updateByPk($id,['is_read'=>1])){
            Yii::app()->user->setFlash('Message','修改成功');

        }else{
            Yii::app()->user->setFlash('Message','修改失败');
        }
        $this->redirect(array('message/index'));
    }

    public function actionDelete()
    {
        $id = $this->_get('id');
        if($id && Message::model()->deleteByPk($id)){
            Yii::app()->user->setFlash('Message','删除成功');

        }else{
            Yii::app()->user->setFlash('Message','删除失败');
        }
        $this->redirect(array('message/index'));
    }
}