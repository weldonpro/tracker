<?php
use app\config\bundles\AppAsset;

use app\models\Project;
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

                    <ul class="nav navbar-nav navbar-right navbar-user">
                        <? if(Yii::$app->user->isGuest): ?>
                            <li>
                                <a href="<?= Yii::$app->urlManager->createUrl('site/login') ?>"><i class="fa fa-unlock"></i> Вход </a>
                            </li>
                            <li>
                                <a href="<?= Yii::$app->urlManager->createUrl('site/signup') ?>"><i class="fa fa-sign-in"></i> Регистрация </a>
                            </li>
                        <? else: ?>
                        <li>
                            <a href="<?= Yii::$app->urlManager->createUrl('dashboard') ?>">
                                <i class="fa fa-pencil-square-o"></i> Трекер
                            </a>
                        </li>
                        <li class="dropdown user-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <? echo Yii::$app->user->identity->username ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="fa fa-user"></i> Профиль</a></li>
                                <li class="divider"></li>
                                <li><a href="<?= Yii::$app->urlManager->createUrl('site/logout') ?>"><i class="fa fa-sign-out"></i> Выход</a></li>
                            </ul>
                        </li>
                        <? endif; ?>
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


	<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
