Profiler: request-response processing timer
===================================
The Profiler class allows you to get an amount of time between request and response.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist aksafan/yii2-profiler "*"
```

or add

```
"aksafan/yii2-profiler": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, you need to configure your @app\config\web or @app\frontend\config\main (in advanced version of yii2).
In order to do this, you should:

 * Add the Profiler class to components section:
 
        'components' => [
                // another components' configs
                'myprofiler' => [
                        'class' => 'aksafan\profiler\Profiler'
                 ],
                // more components' configs
         ],     // end of components section
 
 * Than you need to add 'myprofiler' component to bootstrap section of config:
 
        'bootstrap' => ['log', 'myprofiler'],
 
 * And add 'info' to 'levels' in 'targets' parameter of 'log' component:
 
        'components' => [            
                'log' => [
                    'traceLevel' => YII_DEBUG ? 3 : 0,
                    'targets' => [
                        [
                            'class' => 'yii\log\FileTarget',
                            'levels' => ['error', 'warning', 'info'],
                        ],
                    ],
                ],
        ],
 
 * Logs are here: @app\runtime\logs or @app\frontend\runtime\logs (in advanced version of yii2)