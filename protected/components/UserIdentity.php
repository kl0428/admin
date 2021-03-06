<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	public $_id;
	public $_compay;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$result = Managers::model()->find('name=? and is_quit=?',array(
			$this->username,"0"));
		if ($result )
		{
			if($result->password==md5($this->username.md5($this->password)))
			{
				$this->_id = $result->id;
				$this->errorCode = self::ERROR_NONE;
				$token = md5($result->id.$this->password);
				//Yii::app()->cache_redis->set($result->id.'.UserToken',$token);
				$store = Store::model()->findAll('manager=:id',array(':id'=>$result->id));
				$store_ids = array();
				if($store)
				{
					foreach($store as $key=>$val)
					{
						$store_ids[] = $val->id;
					}
				}
				Yii::app()->user->setState('token',$token);
				Yii::app()->user->setState('info',$result);
				Yii::app()->user->setState('store',$store);
				Yii::app()->user->setState('store_ids',$store_ids);
			}else{
				$this->errorCode = self::ERROR_PASSWORD_INVALID;
			}
		}
		else
		{
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		}
		return !$this->errorCode;
	}

	public function getId()
	{
		return $this->_id;
	}
}