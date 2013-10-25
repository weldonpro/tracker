<?php

namespace app\models;

/**
 * This is the model class for table "task".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $category_id
 * @property integer $user_id
 * @property integer $status
 * @property string $create_time
 * @property string $update_time
 *
 * @property TaskMessage[] $taskMessages
 */
class Task extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'task';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['title, description, category_id, user_id, status, create_time', 'required'],
			['description', 'string'],
			['category_id, user_id, status', 'integer'],
			['create_time, update_time', 'safe'],
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
			'category_id' => 'Category ID',
			'user_id' => 'User ID',
			'status' => 'Status',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
		];
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getTaskMessages()
	{
		return $this->hasMany(Task::className(), ['task_id' => 'id']);
	}
}
