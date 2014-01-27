<?php

namespace app\modules\dashboard;

use app\modules\dashboard\models\Project;

class Module extends \yii\base\Module
{
	public $controllerNamespace = 'app\modules\dashboard\controllers';
    public $defaultController = 'projects';
    public $layout = '@app/modules/dashboard/views/layouts/main.php';
    public $availableProjects;

	public function init()
	{
        if(\Yii::$app->user->isGuest){
            \Yii::$app->user->loginRequired();
        }

        $this->availableProjects = Project::find()->all();

	}
}
