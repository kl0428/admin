<?php
return array(

    'params'=>array(
        // this is used in contact page
      /*  'adminEmail'=>'webmaster@example.com',
        'app'	=>array(
            'MobileApiKey'=>'1234567',
            'MobileApiValidtime'=>10*60,
        ),
        'chuanglan'=>array(
            'api_send_url'=>'http://222.73.117.158/msg/HttpBatchSendSM',//创蓝发送短信接口URL, 如无必要，该参数可不用修改
            'api_balance_query_url'=>'http://222.73.117.158/msg/QueryBalance',//创蓝短信余额查询接口URL, 如无必要，该参数可不用修改
            'api_account'=>'xxxx',//创蓝账号 替换成你自己的账号
            'api_password'=>'xxxx',//创蓝密码，以数字和字母组成的32位字符
        ),
        'cards' =>array(
            0=>array('key'=>0,'name'=>'体验通卡'),
            1=>array('key'=>1,'name'=>'通卡'),
        ),*/
        'banklist' => array(
            'CMB' => '招商银行',
            'ICBC' => '中国工商银行',//ICBC-D
            'CCB' => '中国建设银行',
            'BOC' => '中国银行',
            'ABC' => '中国农业银行',//ABC-D
            'HSBC' => '交通银行',
            'SPDB' => '浦发银行',
            'GDB'=>'广东发展银行',
            'CITIC' => '中信银行',//CITIC-D
            'CEB' => '中国光大银行',
            'CIB'=>'兴业银行',
            'CMBC' => '中国民生银行',
            'HXB' => '华夏银行',
            'SDB' => '平安银行',
            'PSBC' => '中国邮政储蓄银行',
            'HZBANK' => '杭州银行',
        ),
    ),
);
