<?php
/**
 * Created by PhpStorm.
 * User: gongxiaohong
 * Date: 15-11-23
 * Time: 上午10:59
 */
class ApiController extends BaseController
{
    public function actionCity()
    {
        if(isset($_POST) && isset($_POST['code']))
        {
            $code = $_POST['code'];
            if($code)
            {
                $city_obj = YhmCity::model()->findAll('class_parent_id=:id',array(':id'=>$code));

                if($city_obj){
                    foreach($city_obj as $key=>$val)
                    {
                        echo CHtml::tag('option', array('value' => $val->class_id), CHtml::encode($val->class_name), true);
                    }

                }

            }
        }
    }
}