<?php

use app\modules\dashboard\models\TaskCategory;
use app\modules\dashboard\models\Task;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/**
 * @var yii\base\View $this
 * @var app\models\Task $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="task-form">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'title')->textInput(['maxlength' => 512]) ?>

		<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

		<?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map($categories, 'id', 'title')) ?>

		<?= $form->field($model, 'status')->dropDownList(Task::getStatuses()) ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
