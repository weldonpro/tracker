<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\base\View $this
 * @var app\models\TaskMessage $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="task-message-form">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'task_id')->textInput() ?>

		<?= $form->field($model, 'user_id')->textInput() ?>

		<?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

		<?= $form->field($model, 'create_time')->textInput() ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
