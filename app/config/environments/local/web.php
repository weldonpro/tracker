<?php
use yii\helpers\BaseArrayHelper;

return BaseArrayHelper::merge(require(dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.'web.php'), array(
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=tracker_db',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
    ]
));