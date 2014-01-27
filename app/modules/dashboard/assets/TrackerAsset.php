<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 14.11.13
 * Time: 12:25
 */

namespace app\modules\dashboard\assets;

use yii\web\AssetBundle;

class TrackerAsset extends AssetBundle{
    public $sourcePath = '@app/modules/dashboard/assets/source';
    public $css = [];
    public $js= [
        'js/common.js'
    ];
} 