<?php
/**
 * Created by PhpStorm.
 * User: gongxiaohong
 * Date: 15-11-25
 * Time: 下午2:15
 */
Yii::import("application.extensions.Qiniu.*");
use application\extensions\Qiniu\Auth;
use application\extensions\Qiniu\Storage\UploadManager;
function classLoader($class)
{
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $file = __DIR__ . '/../extensions/' . $path . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
}
spl_autoload_register('classLoader');

require_once  __DIR__ . '/../extensions/Qiniu/functions.php';
class StoreController extends BaseController
{
   // public $layout='//layouts/column2';

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // @代表有角色的
                'actions'=>array('view','change','see'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('create','see','update','delete'),
                'expression'=>'$user->getState("info")->authority >= 1',//,array($this,"isSuperUser"),
            ),
            array('deny',  // *代表所有的用户
                'users'=>array('*'),
            ),
        );
    }
    //新增
    public function actionCreate()
    {
        $model = new Store();
        if($_POST['Store'])
        {
            $accessKey = Yii::app()->params['qiniu']['accessKey'];
            $secretKey = Yii::app()->params['qiniu']['secretKey'];
            $auth = new Auth($accessKey, $secretKey);

            $bucket = 'urtime1';
            $token = $auth->uploadToken($bucket);
            $uploadMgr = new UploadManager();
            //上传logo
            if($_FILES['image']['name']!=null)
            {
                $images = array($_FILES['image']);
                $images = $this->setImageInformation($images, $token, $uploadMgr);
                if($images)
                {
                    $_POST['Store']['image'] =  $images[0];
                }
                unset($_FILES['image']);
            }

            //上传营业执照
            if($_FILES['bussiness_license1']['name']!=null ||$_FILES['bussiness_license2']['name']!=null)
            {
                $images = array($_FILES['bussiness_license1'],$_FILES['bussiness_license2']);
                $images = $this->setImageInformation($images, $token, $uploadMgr);
                if($images)
                {
                   // $images_str = implode(',',$images);
                    $_POST['Store']['bussiness_license'] = json_encode($images);//$images_str;
                }
                unset($_FILES['bussiness_license1']);
                unset($_FILES['bussiness_license2']);
            }

            //上传介绍图片
            if($_FILES['upImage']['name']!=null)
            {
                $images = $this->setImageInformation($_FILES, $token, $uploadMgr);
                if($images)
                {
                    //$images_str = implode(',',$images);
                    $_POST['Store']['images_str'] =json_encode($images);//$images_str;
                }
            }


            $model->attributes=$_POST['Store'];

            if($model->validate() && $model->save()){
                //$this->redirect('site/index');
                Yii::app()->user->setFlash('create','成功','失败');
               // Yii::app()->end();
                $this->redirect(array('/store/view'));

            }
        }
        $managers = Managers::model()->loadStaffAllModel();
        $this->render('create',['model'=>$model,'managers'=>$managers]);
    }

    //图片函数
    public function setImageInformation($image,$token,$uploadMgr){
        $images = array();
        foreach($image as $file){
            $name=$file['name'];
            $arr=explode('.',$name);
            $ext=$arr[count($arr)-1];
            $key="urtime".date("YmdHis").mt_rand(1,9999).".".$ext;
            $filePath = $file['tmp_name'];
            list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
            if ($err !== null) {
                $images ['err'][] = $err;
            } else {
                $images[] = $ret['key'];
            }

        }
        return $images;
    }

    //商贾列表
    public function actionView()
    {
        $model = new Store('search');
        $model->unsetAttributes();
        $names = Store::model()->getName();
        if($_GET['Store'])
            $model->attributes = $_GET['Store'];
        $this->render('view',['model'=>$model,'names'=>$names]);
    }


    public function actionSee()
    {
        $id = $this->_get('id');
        if($id)
        {
            $model = Store::model()->findByPk($id);
            $bussiness_license = array();
            $images = array();
            if($model->bussiness_license){
                $bussiness_license = json_decode($model->bussiness_license);
            }

            if($model->images_str)
            {
                $image = json_decode($model->images_str);
                if($image){
                    foreach($image as $key=>$val)
                    {
                        $images[] = Yii::app()->params['qiniu']['host'].$val;
                    }
                }
            }
           /* var_dump($bussiness_license);
            exit;*/
            $this->render('see',['model'=>$model,'bussiness_license'=>$bussiness_license,'images'=>$images]);
        }else{
            $this->redirect(array('/site/index'));
        }
    }



    public function actionChange()
    {
        $id = $this->_get('id');

        if($id)
        {
            $accessKey = Yii::app()->params['qiniu']['accessKey'];
            $secretKey = Yii::app()->params['qiniu']['secretKey'];
            $auth = new Auth($accessKey, $secretKey);

            $bucket = 'urtime1';
            $token = $auth->uploadToken($bucket);
            $uploadMgr = new UploadManager();

            $model = Store::model()->findByPk($id);
            $bussiness_license = array();
            $images = array();
            if($model->bussiness_license){
                $bussiness_license = json_decode($model->bussiness_license);
            }

            if($model->images_str)
            {
                $image = json_decode($model->images_str);
                if($image){
                    foreach($image as $key=>$val)
                    {
                        $images = Yii::app()->params['qiniu']['host'].$val;
                    }
                }
            }

            if($_POST['Store'])
            {
                //上传logo
                if($_FILES['image']['name']!=null)
                {
                    $images = array($_FILES['image']);
                    $images = $this->setImageInformation($images, $token, $uploadMgr);
                    if($images)
                    {
                        $_POST['Store']['image'] =  $images[0];
                    }
                    unset($_FILES['image']);
                }else{
                    unset($_FILES['image']);
                }

                //上传营业执照
                if($_FILES['bussiness_license1']['name']!=null ||$_FILES['bussiness_license2']['name']!=null)
                {
                    if($model->bussiness_license) {
                        if ($_FILES['bussiness_license1']['name'] != null || $_FILES['bussiness_license2']['name'] == null) {
                            $bussiness = json_decode($model->bussiness_license);
                            $images = array($_FILES['bussiness_license1']);
                            $images = $this->setImageInformation($images, $token, $uploadMgr);
                            $bussiness[0] = $images[0];
                            $_POST['Store']['bussiness_license'] = json_encode($bussiness);//$images_str;
                        } else if ($_FILES['bussiness_license1']['name'] == null || $_FILES['bussiness_license2']['name'] != null) {
                            $bussiness = json_decode($model->bussiness_license);
                            $images = array($_FILES['bussiness_license2']);
                            $images = $this->setImageInformation($images, $token, $uploadMgr);
                            $bussiness[1] = $images[0];
                            $_POST['Store']['bussiness_license'] = json_encode($bussiness);//$images_str;
                        } else {
                            $images = array($_FILES['bussiness_license1'], $_FILES['bussiness_license2']);
                            $images = $this->setImageInformation($images, $token, $uploadMgr);
                            if ($images) {
                                // $images_str = implode(',',$images);
                                $_POST['Store']['bussiness_license'] = json_encode($images);//$images_str;
                            }
                        }
                    }else{
                        $images = array($_FILES['bussiness_license1'], $_FILES['bussiness_license2']);
                        $images = $this->setImageInformation($images, $token, $uploadMgr);
                        if ($images) {
                            // $images_str = implode(',',$images);
                            $_POST['Store']['bussiness_license'] = json_encode($images);//$images_str;
                        }
                    }
                    unset($_FILES['bussiness_license1']);
                    unset($_FILES['bussiness_license2']);
                }else{
                    unset($_FILES['bussiness_license1']);
                    unset($_FILES['bussiness_license2']);
                }

                //上传介绍图片
                if($_FILES['upImage']['name']!=null)
                {
                    $images = $this->setImageInformation($images, $token, $uploadMgr);
                    if($images)
                    {
                        //$images_str = implode(',',$images);
                        $_POST['Store']['images_str'] =json_encode($images);//$images_str;
                    }
                }
                $model->attributes=$_POST['Store'];

                if($model->validate() && $model->save()){
                    //$this->redirect('site/index');
                    Yii::app()->user->setFlash('create','成功','失败');
                    // Yii::app()->end();
                    $this->redirect(array('/store/view'));

                }
            }
            $is_manager = Yii::app()->user->getState("info")->authority>=1?1:0;


//             var_dump($images);
//             exit;
            $managers = Managers::model()->loadStaffAllModel();
            $this->render('change',['model'=>$model,'bussiness_license'=>$bussiness_license,'images'=>$images,'managers'=>$managers,'is_manager'=>$is_manager]);
        }else{
            $this->redirect(array('/site/index'));
        }
    }

    public function actionPass()
    {
        $id = $this->_get('id');
        $model = Store::model()->findByPk($id);
        if($model)
        {
            $model->setAttribute('is_open','1');
            if($model->validate() && $model->save()){
                //$this->redirect('site/index');
                Yii::app()->user->setFlash('create','成功','失败');
                // Yii::app()->end();
                $this->redirect(array('/store/view'));
            }
        }
        $this->redirect(array('/store/view'));
    }

    public function actionDelete()
    {
        $id = $this->_get('id');
        $model = Store::model()->findByPk($id);
        if($model)
        {
            $model->setAttribute('is_open','3');
            if($model->validate() && $model->save()){
                //$this->redirect('site/index');
                Yii::app()->user->setFlash('create','成功','失败');
                // Yii::app()->end();
                $this->redirect(array('/store/view'));
            }
        }
        $this->redirect(array('/store/view'));
    }


}