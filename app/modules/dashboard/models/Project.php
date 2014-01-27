<?php

namespace app\modules\dashboard\models;

use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "project".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $user_id
 * @property string $create_time
 * @property string $update_time
 *
 * @property User $user
 * @property ProjectUser[] $projectUsers
 * @property TaskCategory[] $taskCategories
 */
class Project extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'project';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['title', 'description'], 'required'],
			['description', 'string'],
            ['user_id', 'default', 'value'=>\Yii::$app->user->id],
			['user_id', 'integer'],
            [['create_time', 'update_time'], 'safe'],
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
			'user_id' => 'User ID',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
		];
	}

    public function behaviors(){
        return array(
            'timestamp' => ['class' => 'yii\behaviors\AutoTimestamp', 'timestamp'=>new Expression('NOW()'), 'attributes' => [
                ActiveRecord::EVENT_BEFORE_INSERT => 'create_time',
                ActiveRecord::EVENT_BEFORE_UPDATE => 'update_time',
            ]],
        );
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
	public function getProjectUsers()
	{
		return $this->hasMany(ProjectUser::className(), ['project_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getTaskCategories()
	{
		return $this->hasMany(Project::className(), ['project_id' => 'id']);
	}
}
