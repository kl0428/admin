<?php
/**
 * Created by PhpStorm.
 * User: gongxiaohong
 * Date: 15-12-2
 * Time: 下午5:15
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
class DynamicController extends BaseController
{
    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // @代表有角色的
                'actions'=>array('index','change','view','create'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('delete'),
                'expression'=>'$user->getState("info")->authority >= 1',//,array($this,"isSuperUser"),
            ),
            array('deny',  // *代表所有的用户
                'users'=>array('*'),
            ),
        );
    }
    public function actionCreate()
    {
        $model = new Dynamic();
        if($_POST['Dynamic'])
        {
            $accessKey = Yii::app()->params['qiniu']['accessKey'];
            $secretKey = Yii::app()->params['qiniu']['secretKey'];
            $auth = new Auth($accessKey, $secretKey);

            $bucket = 'urtime1';
            $token = $auth->uploadToken($bucket);
            $uploadMgr = new UploadManager();
            $_POST['Dynamic']['dy_type'] = 2;
            /*var_dump($_POST['Dynamic']);
            var_dump($_FILES);
            exit;*/
            if($_FILES['upImage']['name']!=null)
            {
                $images = $this->setImageInformation($_FILES, $token, $uploadMgr);
                if($images)
                {
                    //$images_str = implode(',',$images);
                    $_POST['Dynamic']['dy_images'] =json_encode($images);//$images_str;
                }
            }

            $model->attributes=$_POST['Dynamic'];

            if($model->validate() && $model->save()){
                //$this->redirect('site/index');
                Yii::app()->user->setFlash('dynamic','创建成功');
                // Yii::app()->end();
                $this->redirect(array('/dynamic/index'));

            }
        }
        $stores = Store::model()->getName();
        $this->render('create',['model'=>$model,'stores'=>$stores]);
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


    public function actionIndex()
    {
       /*var_dump(Yii::app()->user->getState('store_ids'));
        exit();*/
        $model = new Dynamic('search');
        $model->unsetAttributes();
        $names = Store::model()->getName();
        if($_GET['Dynamic'])
            $model->attributes = $_GET['Dynamic'];
        $this->render('index',['model'=>$model,'names'=>$names]);
    }

    public function actionView()
    {
        $id = $this->_get('id');
        if($id)
        {
            $model = Dynamic::model()->findByPk($id);
            $images = array();
            if($model->dy_images)
            {
                $image = json_decode($model->dy_images);
                foreach($image as $key=>$val)
                {
                    $images[] = Yii::app()->params['qiniu']['host'].$val;
                }
            }
            $this->render('view',['model'=>$model,'images'=>$images]);
        }else{
            $this->redirect(array('/site/index'));
        }
    }

    public function actionChange()
    {
        $id = $this->_get('id');

        if($id)
        {
            $model = Dynamic::model()->findByPk($id);
            if($_POST['Dynamic'])
            {
                $accessKey = Yii::app()->params['qiniu']['accessKey'];
                $secretKey = Yii::app()->params['qiniu']['secretKey'];
                $auth = new Auth($accessKey, $secretKey);

                $bucket = 'urtime1';
                $token = $auth->uploadToken($bucket);
                $uploadMgr = new UploadManager();
                $_POST['Dynamic']['dy_type'] = 2;
                if($_FILES['upImage']['name']!=null)
                {
                    $images = $this->setImageInformation($_FILES, $token, $uploadMgr);
                    if($images)
                    {
                        //$images_str = implode(',',$images);
                        $_POST['Dynamic']['dy_images'] =json_encode($images);//$images_str;
                    }
                }

                $model->attributes=$_POST['Dynamic'];

                if($model->validate() && $model->save()){
                    //$this->redirect('site/index');
                    Yii::app()->user->setFlash('dynamic','修改成功');
                    // Yii::app()->end();
                    $this->redirect(array('/dynamic/index'));

                }
            }
            $images = array();
            if($model->dy_images)
            {
                $image = json_decode($model->dy_images);
                foreach($image as $key=>$val)
                {
                    $images[] = Yii::app()->params['qiniu']['host'].$val;
                }
            }
            $stores = Store::model()->getName();
            $this->render('change',['model'=>$model,'images'=>$images,'stores'=>$stores]);
        }else{
            $this->redirect(array('/site/index'));
        }
    }

}