<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name' => '草根投资网站运营管理系统',
    'language' => 'zh_cn',
    'charset' => 'utf-8',
    'theme' => 'classic',

    // preloading 'log' component
    'preload'=>array('log'),

    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.*',
        'application.behaviors.*',
        //'application.modules.rights.*',
        //'application.modules.rights.components.*', // Correct paths if necessary.
        'application.extensions.MongoYii.*',
        'application.extensions.MongoYii.validators.*',
        'application.extensions.MongoYii.behaviors.*',
        'application.extensions.MongoYii.util.*',
        'application.extensions.EMongoDbLogRoute.*',
        'application.extensions.phpqrcode.*',
    ),

    // => array('MyEventHandler', 'BeginRequestMethod'),
    //'onEndRequest' => array('MyEventHandler', 'EndRequestMethod'),
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123456',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
//            'newFileMode' => 0666,
//            'newDirMode' => 0777,
        ),
        /*'rights' => array(
            'superuserName' => 'admin', // Name of the role with super user privileges.
            'authenticatedName' => 'Authenticated', // Name of the authenticated user role.
            'userClass' => 'SysUser',
            'userIdColumn' => 'id', // Name of the user id column in the database.
            'userNameColumn' => 'login_name', // Name of the user name column in the database.
            'enableBizRule' => true, // Whether to enable authorization item business rules.
            'enableBizRuleData' => true, // Whether to enable data for business rules.
            'displayDescription' => true, // Whether to use item description instead of name.
            'flashSuccessKey' => 'RightsSuccess', // Key to use for setting success flash messages.
            'flashErrorKey' => 'RightsError', // Key to use for setting error flash messages.
            'install' => false, // Whether to install rights.
            'baseUrl' => '/rights', // Base URL for Rights. Change if module is nested.
            'layout' => 'rights.views.layouts.main', // Layout to use for displaying Rights.
            'appLayout' => 'application.views.layouts.main', // Application layout.
            'cssFile' => 'rights.css', // Style sheet file to use for Rights.
            'debug' => true,
        ),*/

    ),

    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            //'class' => 'RWebUser',
            'allowAutoLogin' => true,
            'loginUrl' => array('site/login'),
        ),

        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                // '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),

        'JpushMessage' => array(
            'class' => 'application.vendor.JpushComponent',
            'appKey' => '597c87047522b92d2f7f42c2',
            'masterSecret' => '749605caded14e2e53323b59',
            'environment' => false,  //false 表示开发环境　　　true表示生产环境
        ),

        'aes256' => array(
            'class' => 'ext.encrypt.Aes256',
            'privatekey_32bits_hexadecimal' => 'Ibs09foGZqwr2k3SNHa1PMhjUBODFc8mzLCvTAWXYuJepg7QiRnVy45Ktx6dlE',
        ),
        'cryptaes' => array(
            'class' => 'ext.encrypt.CryptAes',
            'secret_key' => 'cgtz',
        ),
        'cry' => array(
            'class' => 'CSecurityManager',
            'encryptionKey' => 'cgtz',
//            'cryptAlgorithm'=>'ecb',
        ),
        /* 'db'=>array(
            'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
        ), */
        // uncomment the following to use a MySQL database

        /*'db'=>array(
            'connectionString' => 'mysql:host=192.168.10.32;port=3306;dbname=cgtz_review',
            'emulatePrepare' => true,
            'username' => 'admin',
            'password' => 'cgtz2014',
            'charset' => 'utf8',
            'tablePrefix' => 't_',
            'schemaCacheID' => 'cache_file',
            'schemaCachingDuration' => 0,
            'enableParamLogging' => true,
        ),
        'op_slaver' => array(
            'connectionString' => 'mysql:host=192.168.10.32;port=3309;dbname=cgtz_review',
            'emulatePrepare' => true,
            'username' => 'admin',
            'password' => 'cgtz2014',
            'charset' => 'utf8',
            'tablePrefix' => 't_',
            'schemaCacheID' => 'cache_file',
            'schemaCachingDuration' => 0,
            'enableParamLogging' => true,
        ),
        'db_reader' => array(
            'class' => 'system.db.CDbConnection',
            'connectionString' => 'mysql:host=192.168.10.32;port=3309;dbname=cgtz',
            'emulatePrepare' => true,
            'username' => 'admin',
            'password' => 'cgtz2014',
            'charset' => 'utf8',
            'tablePrefix' => 't_',
            'schemaCacheID' => 'cache_file',
            'schemaCachingDuration' => 0,
            'enableParamLogging' => true,
        ),
        'db_slaver' => [
            'class' => 'system.db.CDbConnection',
            'connectionString' => 'mysql:host=192.168.10.32;port=3309;dbname=cgtz',
            'emulatePrepare' => true,
            'username' => 'admin',
            'password' => 'cgtz2014',
            'charset' => 'utf8',
            'tablePrefix' => 't_',
            'schemaCacheID' => 'cache_file',
            'schemaCachingDuration' => 0,
            'enableParamLogging' => true,
        ],
        'cache_file' => array(
            'class' => 'CFileCache',
        ),

        'cache' => array(
            'class' => 'ext.redis.CRedisCache',
            'keyPrefix' => false,
            'hashKey' => false,
            //'serializer'=>false,
            'servers' => array(
                array(
                    'host' => '192.168.10.106',
                    'port' => 6379,
                    'password' => '00000000',
                ),
            ),
        ),

        'cache3' => array(
            'class' => 'ext.redis.CRedisCache',
            'keyPrefix' => false,
            'hashKey' => false,
            //'serializer'=>false,
            'servers' => array(
                array(
                    'host' => '192.168.10.106',
                    'port' => 6379,
                    'password' => '00000000',
                    'database'=> 3
                ),
            ),
        ),

        'cache2' => array(
            'class' => 'ext.redis.CRedisCache',
            'keyPrefix' => '',
            'hashKey' => false,
            'serializer' => false,
            'servers' => array(
                array(
                    'host' => '192.168.10.106',
                    'port' => 6379,
                    'password' => '00000000',

                ),
            ),
        ),
        'cache_redis' => array(
            'class' => 'ext.redis.CgtzRedisCache',
            'keyPrefix' => false,
            'hashKey' => false,
            'serializer' => false,
            'hostname' => '192.168.10.106',
            'port' => 6379,
            'password' => '00000000',
            'database' => 0,
        ),
        'cache_redis2' => array(
            'class' => 'ext.redis.CgtzRedisCache',
            'keyPrefix' => false,
            'hashKey' => false,
            'serializer' => false,
            'hostname' => '192.168.10.188',
            'port' => 6379,
            'password' => '00000000',
            'database' => 0,
        ),
        'cache_redis3' => array(
            'class' => 'ext.redis.CgtzRedisCache',
            'keyPrefix' => false,
            'hashKey' => false,
            'serializer' => false,
            'hostname' => '192.168.10.106',
            'port' => 6379,
            'password' => '00000000',
            'database' => 3,
        ),
        'cache_redis8' => array(
            'class' => 'ext.redis.CgtzRedisCache',
            'keyPrefix' => false,
            'hashKey' => false,
            'serializer' => false,
            'hostname' => '192.168.10.106',
            'port' => 6379,
            'password' => '00000000',
            'database' => 8,
        ),
        'cache_channel' => array(
            'class' => 'ext.redis.CgtzRedisCache',
            'keyPrefix' => false,
            'hashKey' => false,
            'serializer' => false,
            'hostname' => '192.168.10.106',
            'port' => 6379,
            'password' => '00000000',
            'database' => 2,
        ),

        'cache_project'=>array(
            'class' => 'ext.redis.CgtzRedisCache',
            'keyPrefix' => false,
            'hashKey' => false,
            'serializer' => false,
            'hostname' => '192.168.10.30',
            'port' => 6402,
            'password' => '00000000',
            'database' => 0,
            'timeout' => 2.5,
        ),

        'cache_info'=>array(
            'class' => 'ext.redis.CgtzRedisCache',
            'keyPrefix' => false,
            'hashKey' => false,
            'serializer' => false,
            'hostname' => '192.168.10.30',
            'port' => 6403,
            'password' => '00000000',
            'database' => 0,
            'timeout' => 2.5,
        ),

        'cache_69'=>array(
            'class' => 'ext.redis.CgtzRedisCache',
            'keyPrefix' => false,
            'hashKey' => false,
            'serializer' => false,
            'hostname' => '192.168.10.106',
            'port' => 6379,
            'password' => '00000000',
            'database' => 0,
            'timeout' => 2.5,
        ),

        'mongodb' => array(
            'class' => 'EMongoClient',
            'server' => 'mongodb://192.168.10.188:27017',
            'db' => 'userDb'
        ),*/
        /*'authManager' => array(
            'class' => 'RDbAuthManager',
            'connectionID' => 'db',
            'assignmentTable' => "{{authassignment}}",
            'itemTable' => "{{authitem}}",
            'itemChildTable' => "{{authitemchild}}",
            'rightsTable' => "{{rights}}",
            'defaultRoles' => array('Authenticated', 'Guest'),
        ),*/
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            // 'autoDump'=>false,
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'enabled' => true,
                    'categories' => 'system.db.CDbCommand',
                    'levels' => 'trace,error,warning',
                    'filter' => array(
                        'class' => 'CLogFilter',
                        'logUser' => true,
                        'prefixUser' => true,
                    ),
                    'logFile' => 'db.log',
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'enabled' => true,
                    'levels' => 'error,warning,info',
                    'categories' => 'datasync',
                    'logFile' => 'datasync.log',
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'enabled' => true,
                    'levels' => 'error,warning',
                    'filter' => array(
                        'class' => 'CLogFilter',
                        'logUser' => true,
                        'prefixUser' => true,
                    ),
                ),
                array(
                    'class' => 'CWebLogRoute',
                    'enabled' => true,
                    'categories' => 'system.db.*',
                    'levels' => 'trace,error,warning',
                    'showInFireBug' => true,
                ),
                array(
                    'class'=>'CFileLogRoute',
                    'enabled'=>true,
                    'levels'=>'error,warning,info',
                    'categories'=>'datasync',
                    'logFile'=>'datasync.log',
                ),
                array(
                    'class'=>'CFileLogRoute',
                    'enabled'=>true,
                    'levels'=>'error,warning,info',
                    'categories'=>'application.project.initBalance',
                    'logFile'=>'initBalance.log',
                ),
                array(
                    'class'=>'CFileLogRoute',
                    'enabled'=>true,
                    'levels'=>'error,warning,info',
                    'categories'=>'create_zhi_tou',
                    'logFile'=>'zhi_tou.log',
                ),

                array(
                    'class'=>'CFileLogRoute',
                    'enabled'=>true,
                    'levels'=>'error,warning',
                    'filter'=>array(
                        'class'=>'CLogFilter',
                        'logUser'=>true,
                        'prefixUser'=>true,
                    ),
                ),
//                array(
//                    'class'=>'CWebLogRoute',
//                    'enabled'=>true,
//                    'categories'=>'usercont',
//                    'levels'=>'info',
//                    'showInFireBug'=>false,
//                ),
                array(
                    'class' => 'EMongoLogRoute',
                    'connectionId' => 'mongodb', // optional, defaults to 'mongodb'
                    // 'logCollectionName'=>'applactionlog',
                    'enabled' => true,
                    'categories' => 'usercont,jpush,jsonError',
                    'levels' => 'info,error,warning',
                    // 'dbName' => 'test',
                    // 'collectionName' => 'yiilog',
                ),
                // uncomment the following to show log messages on web pages

                /* array(
                    'class'=>'CWebLogRoute',
                    'levels'=>'trace',
                ), */

            ),
        ),
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail'=>'webmaster@example.com',
        'back_host2' => 'http://192.168.10.188:10003/',
        'back_host' => 'http://192.168.10.188:9103/cgtz-rest3/rest/',
        'citys' => array(
            "other"=>"其他地区",
            "hz"=>"杭州",
            "jh"=>"金华",
            "yw"=>"义乌"
        ),
        'cjflx'=>array(
            "0"=>"自由放贷人",
            "1"=>"小额贷款公司",
            "2"=>"其他",
        ),
        'jkrlx'=>array(
            "0"=>"个人",
            "1"=>"企业",
        ),
        'up_path' => '/data/uploadfiles',
        'up_domain' => 'http://img.op.admin.cgtz.com',
        'project_preview_url'=>'http://sun.dev.cgtz.com/',
    ),
);
return CMap::mergeArray($config, require(dirname(__FILE__) . '/params.php'));