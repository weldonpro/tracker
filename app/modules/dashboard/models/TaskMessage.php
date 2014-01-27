<?php

namespace app\modules\dashboard\models;
use yii\db\Expression;

/**
 * This is the model class for table "task_message".
 *
 * @property integer $id
 * @property integer $task_id
 * @property integer $user_id
 * @property string $body
 * @property string $create_time
 *
 * @property Task $task
 */
class TaskMessage extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'task_message';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['task_id, body', 'required'],
			['task_id, user_id', 'integer'],
            ['user_id', 'default', 'value'=>\Yii::$app->user->id],
            ['create_time', 'default', 'value'=>new Expression('NOW()')],
			['body', 'string'],
			['create_time', 'safe']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'task_id' => 'Task ID',
			'user_id' => 'User ID',
			'body' => 'Body',
			'create_time' => 'Create Time',
		];
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getTask()
	{
		return $this->hasOne(Task::className(), ['id' => 'task_id']);
	}

    public function getUser()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'user_id']);
    }
}
