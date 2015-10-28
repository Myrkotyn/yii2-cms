Content Management Module for Yii2
====================
Content Management Module for Yii2

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist nullref/yii2-cms "*"
```

or add

```
"nullref/yii2-cms": "*"
```

to the require section of your `composer.json` file.

Then You have run console command for install this module:

```
php yii module/install product
```

and module will be added to your application config (`@app/config/installed_modules.php`)

Concept
-------

This module allows you to build dynamic pages which consist of blocks (widget with config).
You can create own type of widgets and register it in BlockManager.


BlockManager
------------

This component contains information about available blocks.
You can override it:

```php
    'cms' => [
        'class' => 'nullref\\cms\\Module',
        'blockManagerClass' => 'app\components\BlockManager',
    ],
```

and add in your class own blocks:

```php
class BlockManager extends BaseBlockManager
{
    public function getList()
    {
        return array_merge([
            'smile' => 'app\blocks\smile', //namespace of block files
        ], parent::getList());
    }
}
```

Also you can register your block in runtime:

```php
    Block::getManager()->register('smile','app\blocks\smile');
    //or
    \Yii::$app->getModule($moduleId)->get('blockManager')->register('smile','app\blocks\smile');
```



Block structure convention
--------------------------

Each valid block it's folder with to classes:

- Block - define data block to use
- Widget - run with data when this block use on page

In most cases where is form file in this folder.

When you add own block you have to set unique id and namespace of block files folder.



Using with yii2-admin module
----------------------------

You can use this module with [Yii2 Admin](https://github.com/NullRefExcep/yii2-admin) module.
