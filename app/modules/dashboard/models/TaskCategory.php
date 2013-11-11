<?php

namespace app\modules\dashboard\models;

/**
 * This is the model class for table "task_category".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $project_id
 * @property string $create_time
 *
 * @property Project $project
 */
class TaskCategory extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'task_category';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['title, project_id, create_time', 'required'],
			['description', 'string'],
			['project_id', 'integer'],
			['create_time', 'safe'],
			['title', 'string', 'max' => 512]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'title' => 'Title',
			'description' => 'Description',
			'project_id' => 'Project ID',
			'create_time' => 'Create Time',
		];
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getProject()
	{
		return $this->hasOne(Project::className(), ['id' => 'project_id']);
	}
}
