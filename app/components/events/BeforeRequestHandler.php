<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 26.10.13
 * Time: 13:44
 */

namespace app\components\events;



class BeforeRequestHandler {
    public static function handle($event){
        /*if(\Yii::$app->user->isGuest){
            \Yii::$app->user->loginRequired();
        }*/
        return $event;
    }
} 