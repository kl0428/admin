<?php
/**
 * Created by PhpStorm.
 * User: gongxiaohong
 * Date: 15-12-7
 * Time: 下午2:28
 */

class CardController extends BaseController
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
                'actions'=>array('card','cardType'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('addCardType','changeCardType','deleteType','createCard','changeCard','deleteCard'),
                'expression'=>'$user->getState("info")->authority >= 1',//,array($this,"isSuperUser"),
            ),
            array('deny',  // *代表所有的用户
                'users'=>array('*'),
            ),
        );
    }
    public function actionAddCardType()
    {
        $model = new CardType();
        if($_POST['CardType']){
            $model->attributes=$_POST['CardType'];
            if($model->validate() && $model->save()){
                Yii::app()->user->setFlash('cardType','创建成功');
                $this->redirect(array('card/cardType'));
            }
        }

        $this->render('type_add',array('model'=>$model));
    }

    public function actionCardType()
    {
        $model = new CardType('search');
        $this->render('card_type',['model'=>$model]);
    }

    public function actionChangeCardType()
    {
        $id = $this->_get("id");
        if($id)
        {
            $model = CardType::model()->findByPk($id);
            if($_POST['CardType']){
                $model->attributes = $_POST['CardType'];
                if($model->validate() && $model->save()){
                    Yii::app()->user->setFlash('cardType','修改成功');
                    $this->redirect(array('card/cardType'));
                }

            }
            $this->render('type_add',['model'=>$model]);
        }else{
            $this->redirect(array('card/cardType'));
        }
    }

    public function actionDeleteCardType()
    {
        $id = $this->_get("id");
        if($id)
        {

            if(CardType::model()->deleteByPk($id)){
                    Yii::app()->user->setFlash('cardType','删除成功');
                    $this->redirect(array('card/cardType'));
            }
        }else{
            $this->redirect(array('card/cardType'));
        }

    }

    public function actionCreateCard()
    {

        //$orderNo = substr(md5(time()), 0, 12);
        if($num = intval($_POST['num'])){
            $card_arr = $_POST['Card'];
            $type_id = $card_arr['type_id'];
           if($type_id >=1000){
               $typeid = $type_id;
           }else if($type_id < 1000 && $type_id >=100){
               $typeid = '0'.$type_id;
           }else if($type_id < 100 && $type_id >=10){
               $typeid = '00'.$type_id;
           }else if($type_id < 10 && $type_id >0){
               $typeid = '000'.$type_id;
           }
            $i=1;
            while($num>=$i){
                $card_num = 'U'.$typeid.date('ymd').mt_rand(1000,9999);

                $card_arr['card_num'] = $card_num;
                $model = new Card();
                $model->attributes = $card_arr;
               if($model->validate()&&$model->save())
                {
                   // var_dump($card_num);
                    $i++;
                }else{
                   var_dump($model->getErrors());
               }

            }
            Yii::app()->user->setFlash('Card','创建成功');
            $this->redirect(array('card/card'));


        }else{
            Yii::app()->user->setFlash('card','请输入创建数量');
        }
        $model = new Card();
        $getTypes = CardType::model()->getType();
        $this->render('create',['model'=>$model,'getTypes'=>$getTypes]);
    }

    public function actionCard()
    {
        $model = new Card('search');
        $this->render('card',['model'=>$model]);
    }


    public function actionChangeCard()
    {
        $id = $this->_get("id");
        if($id)
        {
            $model = Card::model()->findByPk($id);
            if($_POST['Card']){
                $model->attributes = $_POST['Card'];
                if($model->validate() && $model->save()){
                    Yii::app()->user->setFlash('Card','修改成功');
                    $this->redirect(array('card/card'));
                }

            }
            $getTypes = CardType::model()->getType();
            $this->render('change',['model'=>$model,'getTypes'=>$getTypes]);
        }else{
            $this->redirect(array('card/card'));
        }
    }

    public function actionDeleteCard()
    {
        $id = $this->_get("id");
        if($id)
        {

            if(Card::model()->deleteByPk($id)){
                Yii::app()->user->setFlash('Card','删除成功');
                $this->redirect(array('card/card'));
            }
        }else{
            $this->redirect(array('card/card'));
        }
    }

}