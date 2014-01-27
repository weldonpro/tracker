<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/**
 * @var yii\base\View $this
 * @var app\modules\dashboard\models\Project $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="bs-example">
    <ul class="nav nav-tabs" style="margin-bottom: 15px;">
        <li class="active"><a href="#form" data-toggle="tab"><? echo Yii::t('dashboard', 'Проект') ?></a></li>
        <li><a href="#categories" data-toggle="tab"><? echo Yii::t('dashboard', 'Категории') ?></a></li>
        <li><a href="#users" data-toggle="tab"><? echo Yii::t('dashboard', 'Privileges') ?></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="form">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => 512]) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="tab-pane" id="categories">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#categoryForm">
                            <? echo Yii::t('dashboard', 'Создать категорию') ?>
                        </a>
                    </h4>
                </div>
                <div id="categoryForm" class="panel-collapse collapse">
                    <div class="panel-body">
                        <?php $form = ActiveForm::begin(); ?>
                        <?= $form->errorSummary($categoryModel) ?>
                        <?= $form->field($categoryModel, 'title')->textInput(['maxlength' => 512]) ?>

                        <?= $form->field($categoryModel, 'description')->textarea(['rows' => 6]) ?>

                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('dashboard', 'Сохранить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
            <?php echo GridView::widget([
                'dataProvider' => $categoriesDataProvider,
                'columns' => [
                    'id',
                    'title',
                    'description:ntext',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

        </div>

        <div class="tab-pane" id="users">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#userForm">
                            <? echo Yii::t('dashboard', 'Add User') ?>
                        </a>
                    </h4>
                </div>
                <div id="categoryForm" class="panel-collapse collapse">
                    <div class="panel-body">
                        <?php $form = ActiveForm::begin(); ?>

                        <?= $form->field($userModel, 'user_id')->dropDownList(ArrayHelper::map(User::find()->all(), 'id', 'username')) ?>

                        <?= $form->field($userModel, 'role')->dropDownList(ProjectUser::getRoles()) ?>

                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('dashboard', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
            <?php echo GridView::widget([
                'dataProvider' => $userDataProvider,
                'columns' => [
                    'username',
                    'role',
                    #['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

        </div>
</div>
