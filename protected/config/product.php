<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name' => '优时',
    'language' => 'zh_cn',
    'charset' => 'utf-8',
    'theme' => 'classic',

    // preloading 'log' component
    'preload'=>array('log'),

    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.*',
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

        /* 'db'=>array(
            'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
        ), */
        // uncomment the following to use a MySQL database

        /*'db'=>array(
            'connectionString' => 'mysql:host=127.0.0.1;port=3306;dbname=urtimer',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'urtimerqwerty',
            'charset' => 'utf8',
            'tablePrefix' => 't_',
        ),*/

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
                    'host' => '127.0.0.1',
                    'port' => 6379,
                   // 'password' => '00000000',
                ),
            ),
        ),

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

            ),
        ),
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail'=>'webmaster@example.com',
        'up_path' => '/data/uploadfiles',
        'up_domain' => 'http://img.op.admin.cgtz.com',
        'project_preview_url'=>'http://sun.dev.cgtz.com/',
    ),
);
return CMap::mergeArray($config, require(dirname(__FILE__) . '/params.php'));