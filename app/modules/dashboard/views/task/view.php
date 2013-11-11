<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\base\View $this
 * @var app\models\Task $model
 */

$this->title = $task->title;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $task->title;
?>
<div class="page-header">
    <h1><?= Html::encode($task->title) ?></h1>
</div>
<div>
    <?= $task->description ?>
</div>

<h2><? echo Yii::t('dashboard', 'Комментарии') ?></h2>
<? foreach($task->messages as $message): ?>
    <div class="message">
        <div class="info">
            <?= $message->user->username ?>, <?= $message->create_time ?>
        </div>
        <?= $message->body ?>
    </div>
<? endforeach; ?>

<h2 class="header">Ответить</h2>
<? $form = \yii\widgets\ActiveForm::begin() ?>
    <? if($newMessage->hasErrors()): ?>
    <div class="alert alert-dismissable alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <? echo $form->errorSummary($newMessage) ?>
    </div>
    <? endif; ?>
    <div class="form-group">
        <? echo $form->field($newMessage, 'body')->textarea(['rows'=>5]) ?>
    </div>
    <div class="form-group">
        <? echo Html::submitButton('Отправить', ['class'=>'push-right']) ?>
    </div>
<? \yii\widgets\ActiveForm::end() ?>