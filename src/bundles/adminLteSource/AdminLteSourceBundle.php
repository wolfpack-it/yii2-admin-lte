<?php

namespace WolfpackIT\adminLte\bundles\adminLteSource;

use yii\bootstrap4\BootstrapAsset;
use yii\bootstrap4\BootstrapPluginAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

/**
 * Class AdminLteSourceBundle
 * @package WolfpackIT\adminLte\bundles
 */
class AdminLteSourceBundle extends AssetBundle
{
    /**
     * @var array
     */
    public $css = [
        YII_ENV_DEV ? 'css/adminlte.css' : 'css/adminlte.min.css'
    ];

    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
        BootstrapPluginAsset::class
    ];

    /**
     * @var array
     */
    public $js = [
        YII_ENV_DEV ? 'js/adminlte.js' : 'js/adminlte.min.js'
    ];

    /**
     * @var string
     */
    public $sourcePath = '@vendor/almasaeed2010/adminlte/dist';
}