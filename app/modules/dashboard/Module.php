<?php

namespace app\modules\dashboard;


class Module extends \yii\base\Module
{
	public $controllerNamespace = 'app\modules\dashboard\controllers';
    public $defaultController = 'projects';
    public $layout = '@app/modules/dashboard/views/layouts/main.php';

	public function init()
	{
        if(\Yii::$app->user->isGuest){
            \Yii::$app->user->loginRequired();
        }
	}
}
