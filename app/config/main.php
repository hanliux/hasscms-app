<?php
$basePath = dirname(__DIR__);
$root = dirname($basePath);

Yii::setAlias("@root", $root);
Yii::setAlias("@core", '@root/core');
Yii::setAlias("@storage", '@root/storage');

$config = [
    'language' => 'zh-CN',
    'sourceLanguage' => 'en-US',
    'basePath' => $basePath,
    'runtimePath' =>'@storage/runtime',
    'vendorPath' => '@root/vendor',
    'bootstrap' => [
        'log',
        'packageAlias'
    ],
    'components' => [
        'assetManager' => [
            "basePath"=>"@webroot/storage/assets",
            "baseUrl"=>"@web/storage/assets",
            'linkAssets' => true,
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => [
                        YII_DEBUG ? 'jquery.js' : 'jquery.min.js'
                    ]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [
                        YII_DEBUG ? 'css/bootstrap.css' : 'css/bootstrap.min.css'
                    ]
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => [
                        YII_DEBUG ? 'js/bootstrap.js' : 'js/bootstrap.min.js'
                    ]
                ]
            ]
        ],
        'cache' => [
            'class' => '\yii\caching\DbCache'
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => [
                        'error',
                        'warning'
                    ]
                ]
            ]
        ],
        'moduleManager' => [
            "class" => 'hass\module\components\ModuleManager'
        ],
        'themeManager' => [
            "class" => 'hass\theme\components\ThemeManager'
        ],
        'packageAlias'=>[
            "class"=>'hass\base\components\PackageAlias'
        ],
        "composerConfigurationReader" => [
            'class' => 'hass\base\components\ComposerConfigurationReader'
        ],
        "i18n"=>[
            "translations" => [
                "*" => [
                    'class' => "yii\i18n\DbMessageSource",
                    'on missingTranslation' => [
                        '\hass\i18n\Module',
                        "missingTranslation"
                    ]
                ],
                "app*" => [
                    'class' =>"yii\i18n\DbMessageSource",
                    'on missingTranslation' => [
                        '\hass\i18n\Module',
                        "missingTranslation"
                    ]
                ],
                "hass*" => [
                    'class' => "yii\i18n\DbMessageSource",
                    'on missingTranslation' => [
                        '\hass\i18n\Module',
                        "missingTranslation"
                    ]
                ]
            ]
        ],
        'config' => [
            'class' => '\hass\config\components\Config', // Class (Required)
            'db' => 'db', // Database Connection ID (Optional)
            'tableName' => '{{%config}}', // Table Name (Optioanl)
            'cacheId' => 'cache', // Cache Id. Defaults to NULL (Optional)
            'cacheKey' => 'hass.config', // Key identifying the cache value (Required only if cacheId is set)
            'cacheDuration' => 100
        ],
        "fileStorage" => [
            'class' => '\hass\attachment\components\FileStorage',
            'filesystem' => [
                'class' => 'creocoder\flysystem\LocalFilesystem',
                'path' => '@webroot/storage/uploads'
            ],
            'baseUrl' => '@web/storage/uploads'
        ],
    ]
];


return $config;