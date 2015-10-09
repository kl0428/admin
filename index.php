<?php

defined('SITEMODE') or define('SITEMODE','DEVELOP');//网站部署模式[DEVELOP|TEST|PRODUCT]
//defined('SITEMODE') or define('SITEMODE','TEST');//网站部署模式[DEVELOP|TEST|PRODUCT]
//defined('SITEMODE') or define('SITEMODE','PRODUCT');//网站部署模式[DEVELOP|TEST|PRODUCT]1
//defined('SITEMODE') or define('SITEMODE','VERIFY');//网站部署模式[DEVELOP|TEST|PRODUCT]
header('X-Powered-By: www.yijiayi.com');
header('Server: YiJiaYi Server/1.0');
// change the following paths if necessary
$yii=dirname(__FILE__).'/protected/framework/yii.php';


switch (SITEMODE) {
    case 'DEVELOP':{
        defined('RECHARGEMARK') or define('RECHARGEMARK', 'test_');
        defined('YII_DEBUG') or define('YII_DEBUG', true);
        defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 1);
        $config = dirname(__FILE__) . '/protected/config/develop.php';
    };
        break;
    case 'TEST':{
        defined('RECHARGEMARK') or define('RECHARGEMARK', '');
        defined('YII_DEBUG') or define('YII_DEBUG', false);
        defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 4);
        $config=dirname(__FILE__).'/protected/config/test.php';
    };
        break;
    case 'PRODUCT':{
        defined('RECHARGEMARK') or define('RECHARGEMARK', '');
        defined('YII_DEBUG') or define('YII_DEBUG', false);
        defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 4);
        $config=dirname(__FILE__).'/protected/config/main.php';
    };
        break;
    default:{
        defined('RECHARGEMARK') or define('RECHARGEMARK', 'test_');
        defined('YII_DEBUG') or define('YII_DEBUG', true);
        $config=dirname(__FILE__).'/protected/config/main.php';
        defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 4);
    };
        break;
}
//$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
//defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
//defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();
