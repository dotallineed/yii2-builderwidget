<?php
/**
 * @link https://www.github.com/dotallineed/yii2-cart
 * @copyright Copyright (c) 2016 dotallineed.com
 * @license http://www.yiiframework.com/license/
 */

namespace magaga\builderwidgets;

use Yii;
use yii\base\BootstrapInterface;
use yii\di\Instance;
use yii\web\User;
use yii\base\Event;

/**
 * Bootstrap class for checking sync between two storages.
 *
 * @author Kinggeorge Magaga <magagageorge@dotallineed.com>
 * @since 1.0
 *
 */
class BuilderWidgetBootstrap implements BootstrapInterface
{
	/**
	 * @param \yii\base\Application $app
	 */
	public function bootstrap($app)
	{
		Event::on(User::className(), User::EVENT_AFTER_LOGIN, function () {
			$storage = Instance::ensure(\Yii::$app->cart->storage, MultipleStorage::className());
			if (get_class($storage) == 'magaga\builderwidgets\MultipleStorage') {
				$cart = Instance::ensure(\Yii::$app->cart, Cart::className());
				$storage->sync($cart);
			}
		});
	}
}