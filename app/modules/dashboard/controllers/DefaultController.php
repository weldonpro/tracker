<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 26.10.13
 * Time: 14:31
 */

namespace app\modules\dashboard\controllers;

use yii\web\Controller;

class DefaultController extends Controller{
    public function actionIndex(){
        return $this->render('index');
    }
} 