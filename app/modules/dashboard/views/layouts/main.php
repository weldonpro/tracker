<?php
use app\config\bundles\AppAsset;

use app\modules\dashboard\models\Project;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\components\widgets\Alert;

/**
 * @var $this \yii\base\View
 * @var $content string
 */
AppAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="<?= Yii::$app->charset ?>"/>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head(); ?>
</head>
<body>
	<?php $this->beginBody(); ?>

        <div id="wrapper">

            <!-- Sidebar -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/"><?= Yii::$app->name ?></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <? foreach($this->context->module->availableProjects as $project): ?>
                            <li>
                                <a href="<?= Yii::$app->urlManager->createUrl('dashboard/project/view', array('id'=>$project->id)) ?>">
                                    <i class="fa fa-tasks"></i> <?= $project->title ?>
                                </a>
                            </li>
                        <? endforeach; ?>
                    </ul>



                    <ul class="nav navbar-nav navbar-right navbar-user">
                        <li class="dropdown messages-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-envelope"></i> <? echo Yii::t('dashboard', 'Проекты') ?> <span class="badge"><?= count($this->context->module->availableProjects) ?></span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= Yii::$app->urlManager->createUrl('dashboard/project/manage') ?>">Создать проект</a></li>
                                <li class="divider"></li>
                                <? foreach($this->context->module->availableProjects as $v): ?>
                                    <li class="dropdown-header"><?= $v->title ?></li>
                                    <li>
                                        <ul>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('dashboard/project/manage', array('id'=>$v->id)) ?>">Изменить</a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('dashboard/project/manage', array('id'=>$v->id, '#'=>'categories')) ?>"><? echo Yii::t('dashboard', 'Управление категориями') ?></a></li>
                                            <li><a href="<?= Yii::$app->urlManager->createUrl('dashboard/project/delete', array('id'=>$v->id)) ?>">Удалить</a></li>
                                        </ul>
                                    </li>
                                    <li class="divider"></li>
                                <? endforeach; ?>
                            </ul>
                        </li>
                        <li class="dropdown messages-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-envelope"></i> Messages <span class="badge">7</span> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header">7 New Messages</li>
                                <li class="message-preview">
                                    <a href="#">
                                        <span class="avatar"><img src="http://placehold.it/50x50"></span>
                                        <span class="name">John Smith:</span>
                                        <span class="message">Hey there, I wanted to ask you something...</span>
                                        <span class="time"><i class="icon-time"></i> 4:34 PM</span>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="#">View Inbox <span class="badge">7</span></a></li>
                            </ul>
                        </li>
                        <li class="dropdown user-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <? echo Yii::$app->user->identity->username ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="icon-user"></i> Профиль</a></li>
                                <li class="divider"></li>
                                <li><a href="<?= Yii::$app->urlManager->createUrl('site/logout') ?>"><i class="icon-power-off"></i> Выход</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>

            <div id="page-wrapper">

                <?=Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]); ?>

                <?=Alert::widget()?>

                <div class="row">
                    <div class="col-lg-12" id="content">
                        <?= $content ?>
                    </div>
                </div>

            </div><!-- /#page-wrapper -->

        </div><!-- /#wrapper -->

	<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
