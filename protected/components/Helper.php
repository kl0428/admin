<?php

class Helper extends CController {

    public static function utf_substr($string, $length, $etc = '...') {
        $result = '';
        $string = html_entity_decode(trim(strip_tags($string)), ENT_QUOTES, 'UTF-8');
        $strlen = strlen($string);
        for ($i = 0; (($i < $strlen) && ($length > 0)); $i++) {
            if ($number = strpos(str_pad(decbin(ord(substr($string, $i, 1))), 8, '0', STR_PAD_LEFT), '0')) {
                if ($length < 1.0) {
                    break;
                }
                $result .= substr($string, $i, $number);
                $length -= 1.0;
                $i += $number - 1;
            } else {
                $result .= substr($string, $i, 1);
                $length -= 0.5;
            }
        }
        $result = htmlspecialchars($result, ENT_QUOTES, 'UTF-8');
        if ($i < $strlen) {
            $result .= $etc;
        }
        return CHtml::encode($result);
    }

    public static function goPage($url, $message, $time = 3) {
        Yii::app()->user->setFlash('rjson', '');
        Yii::app()->user->setFlash('rjson', CJSON::encode(array('msg' => $message, 'url' => $url, 'time' => $time)));
        Yii::app()->controller->redirect(array('user/statePage'));
        Yii::app()->end();
    }

    /**
     * @todo  缩略图
     * @param string $src  大图路径
     * @param string $to   小图路径
     * @param int $to_w    小图宽度
     * @param int $to_h    小图高度
     * @return boolean|string
     */
    public static function smallImg($src, $to, $to_w, $to_h) {

        $data = getimagesize($src); //0为宽，1为高，2为类型

        $srcW = $data[0];
        $srcH = $data[1];
        switch ($data[2]) {
            case 1: //图片类型，1是GIF图
                $im = @ImageCreateFromGIF($src);
                break;
            case 2: //图片类型，2是JPG图
                $im = @imagecreatefromjpeg($src);
                break;
            case 3: //图片类型，3是PNG图
                $im = @ImageCreateFromPNG($src);
                break;
        }
        if (empty($im))
            return false;
        $to_w = ($to_w > $srcW) ? $srcW : $to_w;
        $to_h = ($to_h > $srcH) ? $srcH : $to_h;
        if ($srcW * $to_w > $srcH * $to_h) {
            $to_h = round($srcH * $to_w / $srcW);
        } else {
            $to_w = round($srcW * $to_h / $srcH);
        }
        if (function_exists("imagecreatetruecolor")) {
            $newImg = imagecreatetruecolor($to_w, $to_h);
            ImageCopyResampled($newImg, $im, 0, 0, 0, 0, $to_w, $to_h, $srcW, $srcH);
        } else {
            $newImg = imagecreate($to_w, $to_h);
            ImageCopyResized($newImg, $im, 0, 0, 0, 0, $to_w, $to_h, $srcW, $srcH);
        }
        $todir = dirname($to);
        if (!is_dir($todir))
            @mkdir($todir, 0777, true);
        imagejpeg($newImg, $to);
        imagedestroy($newImg);
        imagedestroy($im);
        return $to;
    }

    /*
     * @todo 获取头像地址
     */

    public static function avatar($avatarId, $size = 80) {

        if (empty($avatarId))
            return Yii::app()->params['mediaUrl'] . '/img/' . $size . '.png';
        return Yii::app()->params['UpYun']['visitUrl'] . $avatarId;
    }

    /*
     * @todo 获取附件地址
     */

    public static function attachUrl($url) {

        if (empty($url))
            return $url;
        return Yii::app()->params['UpYun']['attachUrl'] . $url;
    }

    /*
     * @todo 生成随机码
     */

    public static function randCode($length = 6) {
        //$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%';
        $chars = '0123456789';
        $randpwd = '';
        for ($i = 0; $i < $length; $i++) {
            $randpwd .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        $sess = Yii::app()->session;
        $sess['mobileCode'] = $randpwd;
        return $randpwd;
    }

    /*
     * @todo 输出省份城市
     * @return 字符串
     */

    public static function str_city($city) {
        echo $city == '' ? '' : '，' . $city;
    }

    /*
     * @todo 截图
     * @param $src_file  原文件路径
     * @param $src_file  返回文件路径
     * @param $src_x   截图起始宽度
     * @param $src_y   截图起始高度
     * @param $w  所截宽度
     * @param $h  所截高度
     */

    public static function cropImg($src_file, $dst_file, $src_x, $src_y, $w, $h) {
        if (!file_exists($src_file))
            return false;
        $data = getimagesize($src_file); //0为宽，1为高，2为类型
        switch ($data[2]) {
            case 1: //图片类型，1是GIF图
                $im = @ImageCreateFromGIF($src_file);
                break;
            case 2: //图片类型，2是JPG图
                $im = @imagecreatefromjpeg($src_file);
                break;
            case 3: //图片类型，3是PNG图
                $im = @ImageCreateFromPNG($src_file);
                break;
        }

        $croped = imagecreatetruecolor($w, $h);
        imagecopy($croped, $im, 0, 0, $src_x, $src_y, $w, $h);
        $re = imagejpeg($croped, $dst_file, 100); // 存储图像
        imagedestroy($im);
        imagedestroy($croped);
        return $dst_file;
    }

    /*
     * @todo 验证手机号码
     */

    public static function checkMobile($mobile) {
        return preg_match("/^1[3|4|5|8][0-9]{9}$/", $mobile);
    }

    /*
     * @todo 银行卡图标
     */

    public static function bankicon($id) {
        return Yii::app()->params['mediaUrl'] . '/img/bankicon/' . $id . '.jpg';
    }

    public static function strim($data) {
        if (!is_array($data))
            return false;
        $return = array();
        foreach ($data as $key => $value) {
            $return[$key] = trim($value);
        }
        return $return;
    }

    public static function number2Chinese($num, $m = 1) {
        switch ($m) {
            case 0:
                $CNum = array(
                    array('零', '壹', '贰', '叁', '肆', '伍', '陆', '柒', '捌', '玖'),
                    array('', '拾', '佰', '仟'),
                    array('', '萬', '億', '萬億')
                );
                break;
            default:
                $CNum = array(
                    array('零', '一', '二', '三', '四', '五', '六', '七', '八', '九'),
                    array('', '十', '百', '千'),
                    array('', '万', '亿', '万亿')
                );
                break;
        }
// $cNum = array('零','一','二','三','四','五','六','七','八','九');

        if (is_integer($num)) {
            $int = (string) $num;
        } else if (is_numeric($num)) {
            $num = explode('.', (string) floatval($num));
            $int = $num[0];
            $fl = isset($num[1]) ? $num[1] : FALSE;
        }
// 长度
        $len = strlen($int);
// 中文
        $chinese = array();

// 反转的数字
        $str = strrev($int);
        for ($i = 0; $i < $len; $i+=4) {
            $s = array(0 => $str[$i], 1 => $str[$i + 1], 2 => $str[$i + 2], 3 => $str[$i + 3]);
            $j = '';
// 千位
            if ($s[3] !== '') {
                $s[3] = (int) $s[3];
                if ($s[3] !== 0) {
                    $j .= $CNum[0][$s[3]] . $CNum[1][3];
                } else {
                    if ($s[2] != 0 || $s[1] != 0 || $s[0] != 0) {
                        $j .= $CNum[0][0];
                    }
                }
            }
// 百位
            if ($s[2] !== '') {
                $s[2] = (int) $s[2];
                if ($s[2] !== 0) {
                    $j .= $CNum[0][$s[2]] . $CNum[1][2];
                } else {
                    if ($s[3] != 0 && ($s[1] != 0 || $s[0] != 0)) {
                        $j .= $CNum[0][0];
                    }
                }
            }
// 十位
            if ($s[1] !== '') {
                $s[1] = (int) $s[1];
                if ($s[1] !== 0) {
                    $j .= $CNum[0][$s[1]] . $CNum[1][1];
                } else {
                    if ($s[0] != 0 && $s[2] != 0) {
                        $j .= $CNum[0][$s[1]];
                    }
                }
            }
// 个位
            if ($s[0] !== '') {
                $s[0] = (int) $s[0];
                if ($s[0] !== 0) {
                    $j .= $CNum[0][$s[0]] . $CNum[1][0];
                } else {
// $j .= $CNum[0][0];
                }
            }
            $j.=$CNum[2][$i / 4];
            array_unshift($chinese, $j);
        }
        $chs = implode('', $chinese);
        if ($fl) {
            $chs .= '点';
            for ($i = 0, $j = strlen($fl); $i < $j; $i++) {
                $t = (int) $fl[$i];
                $chs.= $str[0][$t];
            }
        }
        return $chs;
    }
    public static function debtLeftDays($endtime,$interestFrom){
    	$s = strtotime($endtime)-time();
    	if($s<=0) return 0;
    	$n = ceil($s/(24*3600));
    	return $interestFrom>0?$n:$n+1;
    }
    public static function mb_substr_replace($string,$replacement,$start,$length=null,$encoding = 'utf-8')
    {
        if(!$string)
            return $string;
        if ($encoding == null){
            if ($length == null){
                return mb_substr($string,0,$start).$replacement;
            }
            else{
                return mb_substr($string,0,$start).$replacement.mb_substr($string,$start + $length);
            }
        }
        else{
            if ($length == null){
                return mb_substr($string,0,$start,$encoding).$replacement;
            }
            else{
                return mb_substr($string,0,$start,$encoding). $replacement. mb_substr($string,$start + $length,mb_strlen($string,$encoding),$encoding);
            }
        }
    }
    /**
     * 星号替代
     * @param $value
     * @param string $star
     * @param int $begin
     * @param int $length
     * @return string
     */
    public static function startReplace($value,$star='*',$begin=0,$length=4)
    {
        return ($value=='')?false:Helper::mb_substr_replace($value,str_repeat($star,$length),$begin,$length);
    }
    /*
     * @todo 客服代码
     *
     */
    public static function kefu_url(){
    	return "http://qiao.baidu.com/v3/?module=default&controller=im&action=index&ucid=7008869&type=n&siteid=4341387";
    }
    /*
     * @todo 将数据组装成options串
     * @param $data  数据
     * @param $selected  选中值
     */
    public static function treeOptions($data,$selected=0,$id='id',$title='title')
    {
    	$str = '';
    	foreach ($data as $v){
    		if($v->$id==$selected){
    			$str .= '<option value="'.$v->$id.'" selected="selected">+&nbsp;'.$v->$title.'</option>';
    		}else{
    			$str .= '<option value="'.$v->$id.'">+&nbsp;'.$v->$title.'</option>';
    		}
    		if(!empty($v->childs)){
    			foreach($v->childs as $v2){
    				if($v2->$id==$selected){
    					$str .= '<option  value="'.$v2->$id.'" selected="selected">&nbsp;&nbsp;&gt;&nbsp;'.$v2->$title.'</option>';
    				}else{
    					$str .= '<option  value="'.$v2->$id.'">&nbsp;&nbsp;&gt;&nbsp;'.$v2->$title.'</option>';
    				}
    			}
    		}
    	}
    	return $str;
    }

    public static function BrowserIsChrome()
    {
        return strpos($_SERVER['HTTP_USER_AGENT'],'Chrome') !== false;
    }

    public static function  getSysUserInfo()
    {
        $info  = array();
        $users = SysUser::model()->findAll(array('select'=>'id,name'));
        foreach($users as $user)
            $info[$user['id']] = $user['name'];

        return $info;
    }

    /**
     * 生成新文件名
     */
    public static function getNewFileName($extensionName='',$parent_dir = '/data/uploadfiles')
    {
        $user_id     = Yii::app()->user->id;
        $sFileName   = self::getUUIDName($extensionName);
        $filePath    = implode('/',array(
                substr($user_id,0,6),
                substr($user_id,6,2),
                substr($user_id,8,2),
                substr($user_id,10,2),
                date('Y'),
                date('m'),
                date('d'),
            )
        );
        if(!file_exists($parent_dir.'/'.$filePath))
            @mkdir($parent_dir.'/'.$filePath,0777,true);
        return '/'.$filePath.'/'.$sFileName;
    }

	/**
	 * 生成新文件名
	 */
	public static function getNewFileNameThree($extensionName='',$parent_dir = '/data/uploadfiles')
	{
		$user_id     = Yii::app()->user->id;
		$sFileName   = self::getUUIDName($extensionName);
		$filePath    = implode('/',array(
				'compressed_file',
				substr($user_id,6,2),
				substr($user_id,8,2),
				substr($user_id,10,2),
				date('Y'),
				date('m'),
				date('d'),
			)
		);
		if(!file_exists($parent_dir.'/'.$filePath))
			@mkdir($parent_dir.'/'.$filePath,0777,true);
		return '/'.$filePath.'/'.$sFileName;
	}

    /**
     * 生成新文件名
     */
    public static function getNewFileNameTwo($extensionName='',$parent_dir = '/data/uploadfiles')
    {
        $user_id     = Yii::app()->user->id;
        $sFileName   = self::getUUIDName($extensionName);
        $filePath    = implode('/',array(
                151800,
                substr($user_id,6,2),
                substr($user_id,8,2),
                substr($user_id,10,2),
                date('Y'),
                date('m'),
                date('d'),
            )
        );
        if(!file_exists($parent_dir.'/'.$filePath))
            @mkdir($parent_dir.'/'.$filePath,0777,true);
        return '/'.$filePath.'/'.$sFileName;
    }

    public static function getUUIDName($extensionName='')
    {
        return CgUpload::guid().'.'.$extensionName;
    }
    /**
     * 获取后台用户的客户的投资总额
     */
    public function getClientsInvestTotal($user_id)
    {
        $total = 0;
        $sql = 'select user_id from t_crm_relation where crm_id ='.$user_id;
        $clients = Yii::app()->db->createCommand($sql)->queryAll();
        if($clients !== array())
        {
            $user_ids = array();
            foreach($clients as $client)
            {
                $user_ids[] = $client['user_id'];
            }
            $sql = 'select SUM(invest_amount) as total from cgtz.t_transaction where user_id in('.implode(',', $user_ids).')';
            $total = Yii::app()->db->createCommand($sql)->queryScalar();

        }
        return $total;
    }

    public static function getBankName($bankId)
    {
        $cache = Yii::app()->cache_channel->get('cgtz_op_all_banks');
        if($cache)
            $banks = json_decode($cache);
        else
        {
            $banks  = array();
            $remote = HttpLib::get(Yii::app()->params['scripts']['bank_list'],array('user_id'=>Yii::app()->user->id));
            if($remote->success && $remote->result)
            {
                if($remote->result->pageList)
                {
                    foreach($remote->result->pageList as $val)
                    {
                        $banks[$val->bankId] = $val->bankName;
                    }
                }
            }
            Yii::app()->cache_channel->set('cgtz_op_all_banks',json_encode($banks));
        }
        return $banks->$bankId;
    }

    /**
     * 00点到23点
     */
    public static function getHours()
    {
        $hours = array();
        for($i=0;$i<24;$i++)
        {
            $key = $i;
            if($i<10)
                $key = '0'.$i;
            $hours[$key] = $i;
        }
        return $hours;
    }
}
