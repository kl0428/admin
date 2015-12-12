<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");
define('VERSION', time());
defined('ENVIRONMENT') or define('ENVIRONMENT','PRODUCT');
//defined('ENVIRONMENT') or define('ENVIRONMENT','TEST');
//defined('ENVIRONMENT') or define('ENVIRONMENT', 'DEVELOP');
//develop 开发  test测试  product线上
if (ENVIRONMENT === 'DEVELOP') {
    $yii = dirname(__FILE__) . '/library/yiiframework/yii.php';
    // remove the following lines when in production mode
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    // specify how many levels of call stack should be shown in each log message
    defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 1);
}
if (ENVIRONMENT === 'TEST') {

    $yii = dirname(__FILE__) . '/library/yiiframework/yii.php';
    defined('YII_DEBUG') or define('YII_DEBUG', false);
    defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 0);
}
if (ENVIRONMENT === 'PRODUCT') {
    $yii = dirname(__FILE__) . '/library/yiiframework/yii.php';
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);
}
$config = dirname(__FILE__) . '/protected/config/' . strtolower(ENVIRONMENT) . '.php';
require_once $yii;
$app = Yii::createWebApplication($config);
// $app->attachBehavior('app', 'application.behaviors.CgtzBehavior');
$app->run();
