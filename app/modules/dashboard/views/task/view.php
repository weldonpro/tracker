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
<? foreach($task->messages as $message): ?>
    <div class="message">
        <?= $message->body ?>
    </div>
<? endforeach; ?>

<h2 class="header">Ответить</h2>
<? $form = \yii\widgets\ActiveForm::begin() ?>
    <div class="form-group">
        <? echo $form->field($newMessage, 'body')->textarea(['rows'=>5]) ?>
    </div>
    <div class="form-group">
        <? echo Html::submitButton('Отправить', ['class'=>'push-right']) ?>
    </div>
<? \yii\widgets\ActiveForm::end() ?>