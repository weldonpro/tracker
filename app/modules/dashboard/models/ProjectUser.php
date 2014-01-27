<?php

namespace app\models;

/**
 * This is the model class for table "project_user".
 *
 * @property integer $project_id
 * @property integer $user_id
 * @property integer $role
 *
 * @property User $user
 * @property Project $project
 */
class ProjectUser extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'project_user';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['project_id', 'user_id', 'role'], 'required'],
			[['project_id', 'user_id', 'role'], 'integer']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'project_id' => 'Project ID',
			'user_id' => 'User ID',
			'role' => 'Role',
		];
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getProject()
	{
		return $this->hasOne(Project::className(), ['id' => 'project_id']);
	}
}
