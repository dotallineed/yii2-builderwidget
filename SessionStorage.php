<?php
/**
 * @link https://www.github.com/dotallineed/yii2-cart
 * @copyright Copyright (c) 2016 dotallineed.com
 * @license http://www.yiiframework.com/license/
 */
 
namespace dotallineed\widgetsbuilder;

/**
 * SessionStorage is extended from Storage Class
 * 
 * It's specialty for handling read and write cart data into session
 *
 * Usage:
 * Configuration in block component look like this
 *		'cart' => [
 *			'class' => 'dotallineed\widgetsbuilder\Cart',
 *			'storage' => [
 *				'class' => 'dotallineed\widgetsbuilder\SessionStorage',
 *			]
 *		],
 *
 * @author Kinggeorge Magaga <magagageorge@dotallineed.com>
 * @since 1.0
 *
*/

class SessionStorage extends Storage
{
	public function read(Cart $cart)
	{
		$session = \Yii::$app->session;
		if (isset($session[$cart->id]))
			$this->unserialize($session[$cart->id],$cart);
	}
	
	public function write(Cart $cart)
	{
		$session = \Yii::$app->session;
		$session[$cart->id] = $this->serialize($cart);
	}
	
	public function lock($drop, Cart $cart)
	{
		// not implemented, only for db
	}
}