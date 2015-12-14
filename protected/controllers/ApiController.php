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

    public function actionUploadFiles()
    {
        $config = array(
            "savePath" => "upload/" , //保存路径
            "maxSize" => 5000, //单位KB
            "allowFiles" => array(".gif", ".png", ".jpg", ".jpeg", ".bmp"),
            "userId"=>Yii::app()->user->getId(),
        );
        $up = new Uploader( "upFile" , $config );
        Yii::log(json_encode($up),'test','test.pd');
        $info = $up->getFileInfo();
        $data = array(
            'url'=>$info['url'],
            'fileType'=>$info['type'],
            'original'=>$info['originalName'],
            'state'=>$info['state']
        );
        echo CJSON::encode($data);
        Yii::app()->end();
    }

    public function actionGetCardInfo()
    {
        if(Yii::app()->request->isAjaxRequest()){
            $card_num = $this->_post('num');
            if($card_num){
                $obj = Order::model()->find(array('condition'=>'flag_content=:content','params'=>array(':content'=>$card_num)));
                if($obj){

                }
            }
        }
    }
}