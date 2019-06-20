<?php

namespace WolfpackIT\adminLte\bundles;

use WolfpackIT\adminLte\bundles\adminLteFixes\AdminLteFixesBudle;
use WolfpackIT\adminLte\bundles\adminLteSource\AdminLteSourceBundle;
use yii\web\AssetBundle;

/**
 * Class AdminLteBundle
 * @package WolfpackIT\adminLte\bundles
 */
class AdminLteBundle extends AssetBundle
{
    /**
     * @var array
     */
    public $depends = [
        AdminLteSourceBundle::class,
        AdminLteFixesBudle::class
    ];
}