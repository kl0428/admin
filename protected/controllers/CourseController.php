<?php
/**
 * Created by PhpStorm.
 * User: gongxiaohong
 * Date: 15-11-30
 * Time: 下午7:00
 */
class CourseController extends BaseController
{
    //创建课程
    public function actionCreate()
    {
        if(!Yii::app()->user->getId())
        {
            Yii::app()->user->loginRequired();
        }
        $model =  new Course();
        if($_POST['Course'])
        {
            $time_area = '';
            if($_POST['Course']['time_area'])
            {
                $time_area = serialize($_POST['Course']['time_area']);
            }
            $_POST['Course']['time_area'] = $time_area;
            $model->attributes = $_POST['Course'];
            if($model->validate() && $model->save())
            {
                Yii::app()->user->setFlash('course','创建成功');
                $this->redirect(array('course/index'));
            }
        }

        $stores = Store::model()->getName();
        $this->render('create',['model'=>$model,'stores'=>$stores]);
    }

    public function actionIndex()
    {
        $model = new Course('search');
        $model->unsetAttributes();
        $lessons = Course::model()->getLessons();
        if($_GET['Course'])
            $model->attributes = $_GET['Course'];
        $this->render('index',['model'=>$model,'lessons'=>$lessons]);
    }

    public function actionView()
    {
        $id = $this->_get('id');
        if($id)
        {
            $model = Course::model()->with('store')->findByPk($id);
            $time_area = array();
            if($model->time_area){
                $time_area = unserialize($model->time_area);
            }
//            var_dump($time_area);
//            exit;
            $this->render('view',['model'=>$model,'time_area'=>$time_area]);
        }else{
            $this->redirect(array('/site/index'));
        }
    }

    public function actionChange()
    {
        $id = $this->_get("id");
        if($id)
        {
            $model = Course::model()->findByPk($id);
            if($_POST['Course']){
                $time_area = '';
                if($_POST['Course']['time_area'])
                {
                    $time_area = serialize($_POST['Course']['time_area']);
                }
                $_POST['Course']['time_area'] = $time_area;
                $model->attributes = $_POST['Course'];
                if($model->validate() && $model->save())
                {
                    Yii::app()->user->setFlash('course','更新成功');
                    $this->redirect(array('course/index'));
                }
            }
            if($model->time_area){
                $time_area =unserialize($model->time_area);
            }
            $stores = Store::model()->getName();
            $this->render('change',array('model'=>$model,'time_area'=>$time_area,'stores'=>$stores));

        }else{
            $this->redirect(array('/site/index'));
        }
    }

    public function actionDelete()
    {
        $id = $this->_get("id");
        if($id)
        {
            $model = Course::model()->findByPk($id);

            $model->attributes = array('is_check'=>3);
            if($model->validate() && $model->save())
            {
                Yii::app()->user->setFlash('course','删除成功');
                $this->redirect(array('course/index'));
            }

        }else{
            $this->redirect(array('/site/index'));
        }
    }

    public function actionPass()
    {
        $id = $this->_get("id");
        if($id)
        {
            $model = Course::model()->findByPk($id);
            if($model->is_check != 1){
                $model->attributes = array('is_check'=>1);
                if($model->validate() && $model->save())
                {
                    Yii::app()->user->setFlash('course','审核成功');
                    $this->redirect(array('course/index'));
                }
            }else{
                $model->attributes = array('is_check'=>2);
                if($model->validate() && $model->save())
                {
                    Yii::app()->user->setFlash('course','未通过');
                    $this->redirect(array('course/index'));
                }
            }

        }else{
            $this->redirect(array('/site/index'));
        }
    }
}