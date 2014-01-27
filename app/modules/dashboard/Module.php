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
            \Yii::$app->response->send();
        }

        $this->availableProjects = Project::find()
            ->joinWith('projectUsers')
            ->where(['project_user.user_id' => \Yii::$app->user->id])
            ->all();

	}
}
