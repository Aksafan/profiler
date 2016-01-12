<?php
namespace myname\mywidget;

use yii\base\BootstrapInterface;
use yii\base\Application;
use yii\web\Response;

class MyBootstrapClass implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $time = 0;
        $url = null;
        $app->on(Application::EVENT_BEFORE_REQUEST, function () use (&$time) {
            $time = mktime();
        });
        $app->on(Response::EVENT_AFTER_SEND, function () use (&$time, &$url) {
            $url = \Yii::$app->request->absoluteUrl;
            $time = mktime();
        });

        //Logs are here app\frontend\runtime\logs
        \Yii::info($url . ' - ' . $time);
    }
}