<?php

namespace app\modules\dashboard\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\dashboard\models\Project;

/**
 * ProjectSearch represents the model behind the search form about Project.
 */
class ProjectSearch extends Model
{
	public $id;
	public $title;
	public $description;
	public $user_id;
	public $create_time;
	public $update_time;

	public function rules()
	{
		return [
			['id, user_id', 'integer'],
			['title, description, create_time, update_time', 'safe'],
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

	public function search($params)
	{
		$query = Project::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id');
		$this->addCondition($query, 'title', true);
		$this->addCondition($query, 'description', true);
		$this->addCondition($query, 'user_id');
		$this->addCondition($query, 'create_time');
		$this->addCondition($query, 'update_time');
		return $dataProvider;
	}

	protected function addCondition($query, $attribute, $partialMatch = false)
	{
		$value = $this->$attribute;
		if (trim($value) === '') {
			return;
		}
		if ($partialMatch) {
			$value = '%' . strtr($value, ['%'=>'\%', '_'=>'\_', '\\'=>'\\\\']) . '%';
			$query->andWhere(['like', $attribute, $value]);
		} else {
			$query->andWhere([$attribute => $value]);
		}
	}
}
