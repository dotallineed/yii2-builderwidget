Wigets builder
==============
An extension for creating and storing html widgets with content to the database for Yii2 site builder

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist dotallineed/yii2-widgets-builder "dev-master"
```

or add

```
"dotallineed/yii2-widgets-builder": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, Add the following code in your main configuration file

 ```php
 'builderwidgets' => [
            'class' => 'dotallineed\widgetsbuilder\BuilderWidget',
			
            'storage' => [
                'class' => 'dotallineed\widgetsbuilder\MultipleStorage',
                'storages' => [
                    [
                        'class' => 'dotallineed\widgetsbuilder\DatabaseStorage',
                        'table' => 'builder_widgets',
                    ],
                ],
            ]		
			
        ],
 ```

 and simply use it in your code by  :

```php
  $builder_widgets=Yii::$app->builderwidgets;```
