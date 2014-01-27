<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 06.11.13
 * Time: 17:48
 */

namespace app\modules\dashboard\controllers\actions;

use yii\base\Action;
use app\modules\dashboard\models\Project;
use app\modules\dashboard\models\Task;

class ProjectViewAction extends Action{
    public function run($id, $status = false){
        $project = Project::find($id);
        if(!$project){
            throw new \HttpException(404);
        }
        $query = Task::find()
            ->join('LEFT JOIN', 'task_category as task_category', 'category_id = task_category.id')
            ->andWhere('task_category.project_id = :project_id')
            ->params(array(':project_id'=>$id))
            ->orderBy('update_time DESC, id DESC')
           ;
        if($status && $status == 'open'){
            $query->andWhere('status < 10');
        }elseif($status && $status == 'closed'){
            $query->andWhere('status >= 10');
        }
        $tasks = $query->all();
        echo $this->controller->render('view', array('project'=>$project, 'tasks'=>$tasks));
    }
} 