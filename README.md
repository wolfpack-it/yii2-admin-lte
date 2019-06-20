# Admin LTE 3 bundles and widgets for Yii2

This extension provides [Admin LTE 3](https://adminlte.io/themes/dev/AdminLTE/index.html) bundles and widgets for the Yii2 Framework.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```bash
$ composer require wolfpack-it/yii2-admin-lte
```

or add

```
"wolfpack-it/yii2-admin-lte": "^<latest version>"
```

to the `require` section of your `composer.json` file.

## Usage

### Asset bundle
To use the style, the register bundle must be configured (this is also automatically done by the widgets).

```php
$this->registerAssetBundle(\WolfpackIT\adminLte\bundles\AdminLteBundle::class);
```

### Example HTML layout
Base HTML example of structure and additions to use Admin LTE.

#### Body
```html
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- menu -->
        <!-- sidebar -->
        
        <div class="content-wrapper">
            <div class="content-header">
                <!-- header in container -->
            </div>
            <section class="content">
                <!-- content in container-->
            </section>
        </div>
        
        <!-- footer -->
    </div>
</body>
``` 

#### Menu
```php
echo \yii\bootstrap4\NavBar::begin([
    'options' => [
        'class' => ['main-header', 'navbar-expand', 'navbar-light', 'border-bottom'],
    ],
    'renderInnerContainer' => false
]);

echo \yii\bootstrap4\Nav::widget([
    'options' => ['class' => 'navbar-nav'],
    'items' => [
        ['label' => \kartik\icons\Icon::show('bars'), 'linkOptions' => ['data-widget' => 'pushmenu'], 'encode' => false],
    ],
]);

echo \yii\bootstrap4\Nav::widget([
    'options' => ['class' => 'navbar-nav ml-auto'],
    'items' => [
        ['label' => \Yii::t( 'app', 'Home'), 'url' => \Yii::$app->homeUrl],
    ],
]);

NavBar::end();
```

#### Sidebar
```php
\WolfpackIT\adminLte\widgets\SideNavBar::begin([
    'brandLabel' => \Yii::t('app', 'Urban Journalist'),
    'brandTextOptions' => ['class' => ['font-weight-light']],
    'brandUrl' => ['/'],
]);

echo \WolfpackIT\adminLte\widgets\SideNavBarUserPanel::widget([
    'icon' => 'user-secret',
    'label' => 'Guest',
    'url' => ['session/create']
]);

echo \WolfpackIT\adminLte\widgets\SideNav::widget([
    'items' => [
        [
            'icon' => 'home',
            'label' => \Yii::t('app', 'Home'),
            'url' => ['site/index'],
        ],
        [
            'icon' => 'star',
            'label' => \Yii::t('app', 'Submenu'),
            'items' => [
                [
                    'icon' => 'circle',
                    'label' => \Yii::t('app', 'Submenu item'),
                    'url' => ['site/index'],
                ]
            ]
        ]
    ],
]);

\WolfpackIT\adminLte\widgets\SideNavBar::end();
```

#### Footer
TBD

## TODO
- Add tests 

## Credits
- [Joey Claessen](https://github.com/joester89)
- [Wolfpack IT](https://github.com/wolfpack-it)

## License

The MIT License (MIT). Please see [LICENSE](https://github.com/wolfpack-it/yii2-admin-lte/blob/master/LICENSE) for more information.