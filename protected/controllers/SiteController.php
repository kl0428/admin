<?php

class SiteController extends BaseController
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('login'),
				'users'=>array('*')
			),
			array('allow', // @代表有角色的
				'actions'=>array('index','logout','error'),
				'users'=>array('@'),
			),
			/*array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('add','update','delete'),
				'expression'=>array($this,"isSuperUser"),
			),*/
			array('deny',  // *代表所有的用户
				'users'=>array('*'),
			),
		);
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('login'),
				'users'=>array('*')
			),
			array('allow', // @代表有角色的
				'actions'=>array('index','logout','error'),
				'users'=>array('@'),
			),
			/*array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('add','update','delete'),
				'expression'=>array($this,"isSuperUser"),
			),*/
			array('deny',  // *代表所有的用户
				'users'=>array('*'),
			),
		);
	}
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		//var_dump(Yii::app()->authManager->roles);
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo CJSON::encode(['ok'=>false,'msg'=>$error['message']]);
			else
				$this->render('error', array('error'=>$error));
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if(!Helper::BrowserIsChrome())
		{
			$this->renderPartial('download');
			Yii::app()->end();
		}
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
			{
				if(Yii::app()->user->checkAccess("playtocrmdash") && ! Yii::app()->user->checkAccess("cgtz_adminstrator"))
					$this->redirect($this->createUrl("/crm/dashboard"));
				else
					$this->redirect($this->createUrl("/site/index"));
			}
		}
		// display the login form
		$this->renderPartial('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		/*Yii::app()->user->logout();
		$this->redirect(Yii::app()->user->loginUrl);*/
		Yii::app()->user->logout(true);
		Yii::app()->session->clear();
		Yii::app()->session->destroy();
		$this->redirect(Yii::app()->user->loginUrl);
	}
}