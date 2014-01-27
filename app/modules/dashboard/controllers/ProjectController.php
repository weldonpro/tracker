<?php

namespace app\modules\dashboard\controllers;

use app\modules\dashboard\models\TaskCategory;
use app\modules\dashboard\models\Project;
use app\modules\dashboard\models\search\ProjectSearch;
use app\modules\dashboard\models\search\TaskSearch;
use app\modules\dashboard\models\Task;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\VerbFilter;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
{

    public function actions(){
        return array(
            'view'=>'app\modules\dashboard\controllers\actions\ProjectViewAction'
        );
    }

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
	 * Displays a single Project model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{

	}

	/**
	 * Creates a new Project model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionManage($id = false)
	{
        if(!$id){
		    $model = new Project;
        } else {
            $model = $this->findModel($id);
        }

        $query = TaskCategory::find()->where(array('project_id'=>$id));

        $categoryModel = new TaskCategory;

        if($categoryModel->load($_POST)){
            $categoryModel->project_id = $id;
            if($categoryModel->save()){
                $this->refresh('#categories');
            }
        }

        $categoriesDataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		if ($model->load($_POST) && $model->save() && !$categoryModel->hasErrors()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('form', [
				'model' => $model,
                'categoryModel'=>$categoryModel,
                'categoriesDataProvider'=>$categoriesDataProvider
			]);
		}
	}

	/**
	 * Deletes an existing Project model.
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
	 * Finds the Project model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Project the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Project::find($id)) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}
}
