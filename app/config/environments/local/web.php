<?php
use yii\helpers\ArrayHelper;

return ArrayHelper::merge(require(__DIR__ . '/../../web.php'), [
    'modules'=>[
        'gii'=>[
            'class'=>'yii\gii\Module',
            'password'=>'password'
        ]
    ]
]);