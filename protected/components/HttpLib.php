<?php
/**
 * Created by JetBrains PhpStorm.
 * User: geminiblue
 * Date: 13-10-25
 * Time: 下午5:52
 * To change this template use File | Settings | File Templates.
 */
Yii::import('application.components.Snoopy');

class HttpLib
{

	const TOKEN = 'QmgtHujyuJHYvUISolbhm7hYpWVsgTd6Te8WknVndXg';

	/**
	 * @param $url
	 * @param $post_data
	 * @return mixed|null
	 */
	public static function post($url, array $post_data)
	{

        //因线上ＰＨＰ版本为5.5所以移到此处
        $host2 = array(
            'account/register.json',
            'bankBranch/select/branch.json',
            'account/bank/list.json',
            'account/bankcard/bind.json',
            'user/identity/auth.json',
            'loginRest/getUserCenterInfo.json',
            'account/bankcard/modify.json',
        );

		$post_data['_ts'] = time();
		$post_data['token'] = self::TOKEN;
		$post_data['user_id'] = isset($post_data['user_id']) ? $post_data['user_id'] : Yii::app()->user->getId();

		if ($url != 'account/bankcard/bind.json' && $url != 'loginRest/getUserCenterInfo.json' && $url != 'account/bankcard/modify.json') {
			$post_data['access_from'] = 'admin';
		}
		$sdata = array();
		foreach ($post_data as $key => $value) {
			$sdata[$key] = trim($value);
		}
		try {
			$_snoopy = new Snoopy();
			$data = null;

			if (in_array($url, $host2)) {
				$furl = Yii::app()->params['back_host2'] . $url;
			} else {
				$furl = Yii::app()->params['back_host'] . $url;
			}

			$_snoopy->submit($furl, $sdata);
			if ($_snoopy->results != '')
				$data = json_decode($_snoopy->results, true);
//		    var_dump($furl, $sdata, $data);
			self::json_log($_snoopy->results);
			return $data;
		} catch (Exception $ex) {
			return null;
		}
		return null;
	}

	/**
	 * @param $url
	 * @param string $post_data
	 * @return mixed|null
	 */
	public static function get($url, $post_data = '')
	{

        $host2 = array(
            'account/register.json',
            'bankBranch/select/branch.json',
            'account/bank/list.json',
            'account/bankcard/bind.json',
            'user/identity/auth.json',
            'loginRest/getUserCenterInfo.json',
            'account/bankcard/modify.json',
        );


		$str = '';
		if (is_array($post_data)) {
			$post_data['_ts'] = time();
			$post_data['token'] = self::TOKEN;

			foreach ($post_data as $key => $value) {
				$str .= '&' . $key . '=' . urlencode(trim($value));
			}
		}
		try {
			$_snoopy = new Snoopy();
			if (in_array($url, $host2)) {
				$furl = Yii::app()->params['back_host2'] . $url . '?' . substr($str, 1, strlen($str));
			} else {
				$furl = Yii::app()->params['back_host'] . $url . '?' . substr($str, 1, strlen($str));
			}

			$_snoopy->fetch($furl);
			if ($_snoopy->results != '')
				$data = json_decode($_snoopy->results, false);
			self::json_log($_snoopy->results);
			return $data;
		} catch (Exception $ex) {
			return null;
		}
		return null;
	}

	/**
	 * @return mixed
	 */
	public static function getRemoteIp()
	{
		$user_IP = isset($_SERVER["HTTP_X_FORWARDED_FOR"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
		return ($user_IP) ? $user_IP : $_SERVER["REMOTE_ADDR"];
	}

	public static function E($errorCode)
	{
		return isset(Yii::app()->params['error_code'][$errorCode]) ? CHtml::encode(Yii::app()->params['error_code'][$errorCode]) : '未知';
	}

	/**
	 * 记录json_decode错误
	 * @method json_log
	 * @author jiangmin.sun@cgtz.com
	 * @return
	 */
	public static function json_log($json)
	{
		$msg = '';
		switch (json_last_error()) {
			case JSON_ERROR_NONE:
				$msg = ' - 没有错误发生';
				break;
			case JSON_ERROR_DEPTH:
				$msg = ' - 到达了最大堆栈深度';
				break;
			case JSON_ERROR_STATE_MISMATCH:
				$msg = ' - 无效或异常的 JSON';
				break;
			case JSON_ERROR_CTRL_CHAR:
				$msg = ' - 控制字符错误，可能是编码不对';
				break;
			case JSON_ERROR_SYNTAX:
				$msg = ' - 语法错误';
				break;
			case JSON_ERROR_UTF8:
				$msg = ' - 异常的 UTF-8 字符，也许是因为不正确的编码';
				break;
			case JSON_ERROR_RECURSION:
				$msg = ' - One or more recursive references in the value to be encoded';
				break;
			case JSON_ERROR_INF_OR_NAN:
				$msg = ' - One or more NAN or INF values in the value to be encoded ';
				break;
			case JSON_ERROR_UNSUPPORTED_TYPE:
				$msg = ' - A value of a type that cannot be encoded was given';
				breajk;
			default:
				$msg = ' - Unknown error';
				break;
		}
		Yii::log($json . "----" . $msg, 'error', 'jsonError');
	}
}
