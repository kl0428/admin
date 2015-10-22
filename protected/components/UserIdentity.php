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
		$result = User::model()->find('username=? and status=?',array(
			$this->username,"in"));
		if ($result )
		{
			if($result->password==md5($this->username.md5($this->password)))
			{
				$this->_id = $result->id;
				$this->errorCode = self::ERROR_NONE;
				$token = md5($result->id.$this->password);
				Yii::app()->cache_redis->set($result->id.'.UserToken',$token);
				Yii::app()->user->setState('token',$token);
				Yii::app()->user->setState('info',$result);
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