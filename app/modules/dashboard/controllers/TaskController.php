<?php

namespace app\modules\dashboard\controllers;

use app\modules\dashboard\models\TaskMessage;
use app\modules\dashboard\models\TaskCategory;
use app\modules\dashboard\models\Task;
use app\modules\dashboard\models\search\TaskSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\VerbFilter;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
{
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
		];
	}

	/**
	 * Lists all Task models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new TaskSearch;
		$dataProvider = $searchModel->search($_GET);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single Task model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
        $messages = TaskMessage::find()->where(array('task_id'=>$id))->all();
        $newMessage = new TaskMessage();

        if ($newMessage->load($_POST)) {
            $newMessage->task_id = $id;
            if($newMessage->save()){
                return $this->refresh();
            }
        }

		return $this->render('view', [
			'task' => $this->findModel($id),
            'messages'=>$messages,
            'newMessage'=>$newMessage
		]);
	}

	/**
	 * Creates a new Task model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionManage($id = false, $project_id = false)
	{
        if(!$id){
            $model = new Task;
            $model->status = Task::STATUS_NEW;
        }else{
            $model = $this->findModel($id);
        }

		if ($model->load($_POST) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		}

        if(!$model->isNewRecord){
            $project_id = $model->category->project_id;
        }

        $categories = TaskCategory::find()->where(array('project_id'=>$project_id))->all();

        return $this->render('form', [
            'model' => $model,
            'project_id'=>$project_id,
            'categories'=>$categories

        ]);

	}


	/**
	 * Deletes an existing Task model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();
		return $this->redirect(['index']);
	}

	/**
	 * Finds the Task model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Task the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Task::find($id)) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}
}
