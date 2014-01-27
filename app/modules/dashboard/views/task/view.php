<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\base\View $this
 * @var app\models\Task $model
 */

$this->title = $task->title;
$this->params['breadcrumbs'][] = ['label' => $task->category->project->title, 'url' => ['/dashboard/project/view', 'id'=>$task->category->project->id]];
$this->params['breadcrumbs'][] = $task->title;
?>

<h1>
    <?= Html::encode($task->title) ?>
    <a href="<? echo Yii::$app->urlManager->createUrl('/dashboard/task/manage', array('id'=>$task->id)) ?>">
        <i class="fa fa-cogs"></i>
    </a>
</h1>

<div>
    <?= $task->description ?>
</div>

<? if(!empty($task->messages)): ?>
    <h2><? echo Yii::t('dashboard', 'Комментарии') ?> <i class="fa fa-comments"></i></h2>
    <? foreach($task->messages as $message): ?>
        <div class="message">
            <div class="info">
                <?= $message->user->username ?>, <?= $message->create_time ?>
            </div>
            <?= $message->body ?>
        </div>
    <? endforeach; ?>
<? endif; ?>

<h2 class="header"><? echo Yii::t('dashboard', 'Написать') ?> <i class="fa fa-pencil-square-o"></i></h2>
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