<?php

namespace WolfpackIT\adminLte\widgets;

use kartik\icons\Icon;
use WolfpackIT\adminLte\bundles\AdminLteBundle;
use yii\base\InvalidConfigException;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\helpers\ArrayHelper;

/**
 * Class SideNav
 * @package common\themes\AdminLte\widgets
 */
class SideNav extends Nav
{
    /**
     * @var string
     */
    public $dropdownClass = self::class;

    /**
     * @var array
     */
    public $iconOptions = [];

    /**
     * @var bool
     */
    public $isSubMenu = false;

    /**
     * @var array
     */
    public $navOptions = [
        'class' => ['mt-2']
    ];

    /**
     * @var string
     */
    public $navType = 'nav-pills';

    /**
     * @param $items
     * @return bool
     */
    protected function hasActiveChild($items): bool
    {
        foreach ($items as $i => $child) {
            if (is_array($child) && !ArrayHelper::getValue($child, 'visible', true)) {
                continue;
            }
            if ($this->isItemActive($child)) {
                return true;
            }
            $childItems = ArrayHelper::getValue($child, 'items');
            if (is_array($childItems)) {
                $activeParent = false;
                $this->isChildActive($childItems, $activeParent);
                if ($activeParent) {
                    return true;
                }
            }
        }

        return false;
    }

    public function init()
    {
        parent::init();

        Html::addCssClass($this->options, ['nav-sidebar', 'flex-column', $this->navType]);
        $this->options['data-widget'] = 'treeview';
    }

    /**
     * @param array|string $item
     * @return array|string
     * @throws InvalidConfigException
     */
    public function renderItem($item): string
    {
        if (is_string($item)) {
            return $item;
        }
        if (!isset($item['label'])) {
            throw new InvalidConfigException("The 'label' option is required.");
        }
        $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
        $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
        $options = ArrayHelper::getValue($item, 'options', []);
        $items = ArrayHelper::getValue($item, 'items');
        $url = ArrayHelper::getValue($item, 'url', '#');
        $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);
        $disabled = ArrayHelper::getValue($item, 'disabled', false);
        $active = $this->isItemActive($item);

        $iconOptions = ArrayHelper::remove($item, 'iconOptions', []);
        $iconOptions = ArrayHelper::merge($this->iconOptions, $iconOptions);
        Html::addCssClass($iconOptions, 'nav-icon');
        $emptyIconOptions = ['style' => ['color' => 'transparent']];
        $iconHtml = ArrayHelper::getValue($item, 'iconHtml');
        if (empty($iconHtml)) {
            $iconHtml = isset($item['icon'])
                ? Icon::show($item['icon'], $iconOptions)
                : Icon::show('circle', ArrayHelper::merge($iconOptions, $emptyIconOptions));
        }
        if (empty($items)) {
            $subMenu = '';
            $showSubmenu = '';
        } else {
            Html::addCssClass($options, ['has-treeview']);
            $showSubmenu = Icon::show('angle-left', ['class' => 'right']);

            $dropdownOptions = ArrayHelper::getValue($item, 'dropdownOptions', []);
            Html::addCssClass($dropdownOptions, ['nav-treeview']);
            $item['dropdownOptions'] = $dropdownOptions;

            if (is_array($items)) {
                $items = $this->isChildActive($items, $active);
                $subMenu = $this->renderDropdown($items, $item);
            }
        }

        Html::addCssClass($options, 'nav-item');
        Html::addCssClass($linkOptions, 'nav-link');

        if ($disabled) {
            ArrayHelper::setValue($linkOptions, 'tabindex', '-1');
            ArrayHelper::setValue($linkOptions, 'aria-disabled', 'true');
            Html::addCssClass($linkOptions, 'disabled');
        } elseif ($this->activateItems && $active) {
            Html::addCssClass($linkOptions, 'active');
        }

        if (is_array($items) && $this->hasActiveChild($items)) {
            Html::addCssClass($options, ['menu-open']);
        }

        return Html::tag('li', Html::a($iconHtml . Html::tag('p', $label  . $showSubmenu), $url, $linkOptions) . $subMenu, $options);
    }

    /**
     * Renders the given items as a dropdown.
     * This method is called to create sub-menus.
     * @param array $items the given items. Please refer to [[Dropdown::items]] for the array structure.
     * @param array $parentItem the parent item information. Please refer to [[items]] for the structure of this array.
     * @return string the rendering result.
     * @throws \Exception
     */
    protected function renderDropdown($items, $parentItem)
    {
        /** @var self $dropdownClass */
        $dropdownClass = $this->dropdownClass;
        return $dropdownClass::widget([
            'options' => ArrayHelper::getValue($parentItem, 'dropdownOptions', []),
            'items' => $items,
            'encodeLabels' => $this->encodeLabels,
            'clientOptions' => false,
            'view' => $this->getView(),
            'isSubMenu' => true
        ]);
    }

    /**
     * @return string
     * @throws InvalidConfigException
     */
    public function renderItems(): string
    {
        $result = (!$this->isSubMenu ? Html::beginTag('nav', ['class' => 'mt-2']) : '') . "\n";
        $result .= parent::renderItems();
        $result .= (!$this->isSubMenu ? Html::endTag('nav') : '') . "\n";
        return $result;
    }

    public function run()
    {
        AdminLteBundle::register($this->getView());
        return parent::run();
    }


}