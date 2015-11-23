<?php
return array(

    'params'=>array(
        // this is used in contact page
        'adminEmail'=>'webmaster@example.com',
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
        ),
    ),
);
