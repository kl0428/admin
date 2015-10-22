<?php
/**
 * @file nameQRCodeComponent.php
 * @username jiangmin.sun@cgtz.com
 * @date 14-10-21
 * @time 下午3:48
 */
YiiBase::import('application.extensions.phpqrcode.phpqrcode',true);
class QRCodeComponent extends CApplicationComponent {
    public $data;
    public $width;
    public $height;

    public function __set($key,$value){
        $this->$key=$value;
    }

    public function __get($name){
        return $this->$name;
    }

    public function png(){
// 二维码数据
        $data = $this->url;
// 生成的文件名
        $filename = Yii::app()->params['up_path']."/".time().".png";
// 纠错级别：L、M、Q、H
        $errorCorrectionLevel = 'L';
// 点的大小：1到10
        $matrixPointSize = 4;
        QRcode::png($this->data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
        return $filename;
    }
}
 