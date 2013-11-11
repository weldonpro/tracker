<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\base\View $this
 * @var app\models\Project $model
 */

$this->title = $project->title;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
    <a href="<? echo Yii::$app->urlManager->createUrl('dashboard/task/manage', array('project_id'=>$project->id)) ?>" class="btn btn-primary"><? echo Yii::t('dashboard', 'Новая задача') ?></a>
</div>
<div class="table-responsive">
    <table class="table table-hover table-striped tablesorter">
        <thead>
        <tr>
            <th class="header">#</th>
            <th class="header"><? echo Yii::t('tracker', 'Название') ?></th>
            <th class="header"><? echo Yii::t('tracker', 'Категория') ?></th>
            <th class="header"><? echo Yii::t('tracker', 'Статус') ?></th>
            <th class="header"><? echo Yii::t('tracker', 'Последнее изменение') ?></th>
            <th class="header"><? echo Yii::t('tracker', 'Действия') ?></th>
        </tr>
        </thead>
        <tbody>
        <? foreach($tasks as $task): ?>
            <tr>
                <td>
                    #<?= $task->id ?>
                </td>
                <td><?= $task->title ?></td>
                <td><?= $task->category->title ?></td>
                <td><?= $task->statusLabel ?></td>
                <td><?= $task->update_time ?></td>
                <td><? echo Html::a(Yii::t('dashboard', 'Просмотр'), array('/dashboard/task/view', 'id'=>$task->id)) ?></td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>
</div>
