<?php
namespace aksafan\profiler;

use yii\base\BootstrapInterface;
use yii\base\Application;
use yii\web\Response;

/**
 * The Profiler class allows you to get an amount of time between request and response.
 *
 * Before use it, you need to configure your @app\config\web or @app\frontend\config\main (in advanced version of yii2).
 *
 * In order to do this, you should add the Profiler class to components section:
 *  'components' => [
 *      // another components' configs
 *      'myprofiler' => [
 *          'class' => 'aksafan\profiler\Profiler'
 *      ],
 *      // more components' configs
 *  ],  // end of components section
 *
 * Than you need to add 'myprofiler' component to bootstrap section of config:
 *  'bootstrap' => ['log', 'myprofiler'],
 *
 * and add 'info' to 'levels' in 'targets' parameter of 'log' component:
 *  'log' => [
 *      'traceLevel' => YII_DEBUG ? 3 : 0,
 *      'targets' => [
 *          [
 *              'class' => 'yii\log\FileTarget',
 *              'levels' => ['error', 'warning', 'info'],
 *          ],
 *      ],
 *  ],
 *
 * Logs are here: @app\runtime\logs or @app\frontend\runtime\logs (in advanced version of yii2)
 */
class Profiler implements BootstrapInterface
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

        \Yii::info($url . ' - ' . $time);
    }
}