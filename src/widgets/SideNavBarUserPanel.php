<?php

namespace WolfpackIT\adminLte\widgets;

use kartik\icons\Icon;
use WolfpackIT\adminLte\bundles\AdminLteBundle;
use yii\base\InvalidConfigException;
use yii\bootstrap4\Html;
use yii\bootstrap4\Widget;

/**
 * Class UserPanel
 * @package common\themes\AdminLte\widgets
 */
class SideNavBarUserPanel extends Widget
{
    /**
     * @var string
     */
    public $icon = 'user';

    /**
     * @var array
     */
    public $iconOptions = [
        'class' => ['img-circle', 'elevation-2'],
        'style' => ['font-size' => '2.1rem']
    ];

    /**
     * @var string
     */
    public $image;

    /**
     * @var array
     */
    public $imageContainerOptions = [
        'class' => ['text-light']
    ];

    /**
     * @var array
     */
    public $imageOptions = [
        'class' => ['img-circle', 'elevation-2']
    ];

    /**
     * @var string
     */
    public $label;

    /**
     * @var array
     */
    public $labelOptions = [];

    /**
     * @var array
     */
    public $linkOptions = [];

    /**
     * @var array
     */
    public $options = [
        'class' => ['mt-3', 'pb-3', 'mb-3', 'd-flex']
    ];

    /**
     * @var array|string
     */
    public $url;

    public function init()
    {
        if (!isset($this->label)) {
            throw new InvalidConfigException('Label must be set');
        }
        parent::init();
    }

    /**
     * @return string
     * @throws InvalidConfigException
     */
    public function run(): string
    {
        $imageHtml = $this->image ? Html::img($this->image, $this->imageOptions) : Icon::show($this->icon, $this->iconOptions);
        $options = $this->options;
        Html::addCssClass($options, ['user-panel']);

        $imageContainerOptions = $this->imageContainerOptions;
        Html::addCssClass($imageContainerOptions, ['image']);

        $labelOptions = $this->labelOptions;
        Html::addCssClass($labelOptions, ['info']);

        $link = $this->url ?? '#';
        $label = Html::a($this->label, $link, $this->linkOptions);

        $result = Html::beginTag('div', $options);

        $result .= Html::tag('div', $imageHtml, $imageContainerOptions);
        $result .= Html::tag('div', $label, $labelOptions);

        $result.= Html::endTag('div');

        AdminLteBundle::register($this->getView());
        return $result;
    }
}