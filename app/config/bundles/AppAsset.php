<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\config\bundles;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
        'vendor/bootstrap/css/bootstrap.min.css',
		'css/style.css',
        'vendor/font-awesome/css/font-awesome.min.css',
	];
    public $js = [
        'vendor/bootstrap/js/bootstrap.min.js',
    ];
	public $depends = [
		'yii\web\YiiAsset',
	];
}
