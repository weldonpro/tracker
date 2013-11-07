<?php
if(isset($_SERVER['APP_ENV'])){
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', $_SERVER['APP_ENV']);
} else {
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'local');
}

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/yii/Yii.php');

$config = require(__DIR__ . '/../app/config/environments/'.YII_ENV.'/web.php');

$application = new yii\web\Application($config);
$application->run();
