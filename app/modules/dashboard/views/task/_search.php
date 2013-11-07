<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\base\View $this
 * @var app\models\search\TaskSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="task-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'title') ?>

		<?= $form->field($model, 'description') ?>

		<?= $form->field($model, 'category_id') ?>

		<?= $form->field($model, 'user_id') ?>

		<?= // $form->field($model, 'status') ?>

		<?= // $form->field($model, 'create_time') ?>

		<?= // $form->field($model, 'update_time') ?>

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
