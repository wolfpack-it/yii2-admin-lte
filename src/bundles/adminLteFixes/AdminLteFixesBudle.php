<?php

namespace WolfpackIT\adminLte\bundles\adminLteFixes;

use WolfpackIT\adminLte\bundles\adminLteSource\AdminLteSourceBundle;
use yii\web\AssetBundle;

/**
 * Class AdminLteFixesBudle
 * @package WolfpackIT\adminLte\bundles
 */
class AdminLteFixesBudle extends AssetBundle
{
    /**
     * @var array
     */
    public $css = [
        'css/fixes.css'
    ];

    /**
     * @var array
     */
    public $depends = [
        AdminLteSourceBundle::class
    ];

    /**
     * @var string
     */
    public $sourcePath = __DIR__ . '/assets';
}