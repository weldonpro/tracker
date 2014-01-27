<?php

namespace app\modules\dashboard\models;

use \yii\db\Expression;
use \yii\db\ActiveRecord;
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
class Task extends ActiveRecord
{
    const STATUS_NEW = 01;
    const STATUS_IN_PROGRESS = 02;
    const STATUS_FEEDBACK = 03;

    const STATUS_CLOSED = 10;
    const STATUS_RESOLVED = 11;
    const STATUS_CANCELED = 12;
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
			['title, category_id, status', 'required'],
			['description', 'string'],
            ['user_id', 'default', 'value'=>\Yii::$app->user->id],
            // todo: валидатор статуса
			['category_id, user_id, status', 'integer'],
			['create_time, update_time', 'safe'],
			['title', 'string', 'max' => 512],
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

    public function behaviors(){
        return array(
            'timestamp' => [
                'class' => 'yii\behaviors\AutoTimestamp',
                'timestamp'=>new Expression('NOW()'),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_time', 'update_time'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'update_time',
                ]
            ],

        );
    }

    public function getCategory(){
        return $this->hasOne('app\modules\dashboard\models\TaskCategory', array('id'=>'category_id'));
    }

    public static function getStatuses(){
        return [
            self::STATUS_CLOSED => \Yii::t('tracker', 'Закрыто'),
            self::STATUS_NEW => \Yii::t('tracker', 'Новая'),
            self::STATUS_IN_PROGRESS => \Yii::t('tracker', 'В работе'),
            self::STATUS_RESOLVED => \Yii::t('tracker', 'Завершено'),
            self::STATUS_FEEDBACK => \Yii::t('tracker', 'Обратная связь'),
            self::STATUS_CANCELED => \Yii::t('tracker', 'Отменена'),
        ];
    }

    public function getStatusLabel(){
        return self::getStatuses()[$this->status];
    }

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getMessages()
	{
		return $this->hasMany(TaskMessage::className(), ['task_id' => 'id']);
	}

    public function getProject(){
        return $this->hasOne(Project::className(),['id' => 'project_id'])->viaTable(TaskCategory::tableName(), ['id' => 'category_id']);
    }
}
