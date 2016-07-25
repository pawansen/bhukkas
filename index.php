<?php

define('YII_ENABLE_ERROR_HANDLER', false);
define('YII_ENABLE_EXCEPTION_HANDLER', false);

define('S3Path', "https://s3-ap-southeast-1.amazonaws.com/bhukkas-assets/");
define('S3BUCKET', "bhukkas-assets");
define('AWSKEY', "AKIAIJXDXYBBJOOB6TRA");
define('AWSSECRET', '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');
ini_set("display_errors",false);
//error_reporting(E_ALL);

// include Yii bootstrap file
require_once(dirname(__FILE__).'/yiiframework/yii.php');
$config=dirname(__FILE__).'/protected/config/main.php';

// create a Web application instance and run
Yii::createWebApplication($config)->run();