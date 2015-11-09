<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'优时',
    //'defaultController'=>'index',
    'theme' => 'classic',

    // preloading 'log' component
    'preload'=>array('log'),

    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.*',
    ),

    'modules'=>array(
        // uncomment the following to enable the Gii tool

        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'123456',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters'=>array('127.0.0.1','::1'),
        ),

    ),

    // application components
    'components'=>array(

        'user'=>array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'loginUrl' => array('site/login'),
        ),

        // uncomment the following to enable URLs in path-format

        'urlManager'=>array(
            'urlFormat'=>'path',
            'rules'=>array(
               // '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ),
        ),


        // database settings are configured in database.php
        //'db'=>require(dirname(__FILE__).'/database.php'),
        'db'=>array(
            'connectionString' => 'mysql:host=127.0.0.1;port=3306;dbname=urtime',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'urtimerqwerty',
            'charset' => 'utf8',
            'tablePrefix' => 't_',
        ),
        /*'cache_file' => array(
            'class' => 'CFileCache',
        ),*/

        'cache' => array(
            'class' => 'ext.redis.CRedisCache',
            //'keyPrefix' => false,
           // 'hashKey' => false,
            //'serializer'=>false,
            'servers' => array(
                array(
                    'host' => '127.0.0.1',
                    'port' => 6379,
                    //'password' => 'urtimerqwerty',
                ),
            ),
        ),

        'errorHandler'=>array(
            // use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),

        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
                // uncomment the following to show log messages on web pages
                /*
                array(
                    'class'=>'CWebLogRoute',
                ),
                */
            ),
        ),

    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'=>array(
        // this is used in contact page
        'adminEmail'=>'webmaster@example.com',
    ),
);
