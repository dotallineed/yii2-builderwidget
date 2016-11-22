<?php
/**
 * @link https://www.github.com/dotallineed/yii2-builderwidget
 * @copyright Copyright (c) 2016 dotallineed.com
 * @license http://www.yiiframework.com/license/
 */
 
namespace dotallineed\widget;

use yii\di\Instance;

/**
 * MultipleStorage is extended from Storage Class
 * 
 * It's specialty for handling Multiple Storage 
 *
 * Usage:
 * Configuration in block component look like this
 *		'widget' => [
 *			'class' => 'dotallineed\widget\BuilderWidget',
 *			'storage' => [
 *				'class' => 'dotallineed\widget\MultipleStorage',
 *				'storages' => [
 *					['class' => 'dotallineed\widget\SessionStorage'],
 *					[
 *						'class' => 'dotallineed\widget\DatabaseStorage',
 *						'table' => 'widget',
 *					],
 *				],
 *			]
 *		],
 *
 * @author Kinggeorge Magaga <magagageorge@dotallineed.com>
 * @since 1.0
 *
 * Inspired from https://github.com/kajyr/LocalStorage 
 *
*/

class MultipleStorage extends Storage
{
	/**
	 * Array $storage
	 */
	public $storages = [];

	/**
	 *
	 */
	public function init()
	{
		parent::init();
		if (empty($this->storages)) {
			$this->storages = [
				//['class' => SessionStorage::class],
				['class' => DatabaseStorage::class],
			];
		}
		
		$this->storages = array_map(function ($storage) {
			return Instance::ensure($storage, Storage::class);
		}, $this->storages);
	}

	/**
	 * @param BuilderWidget $widget
	 */
	public function sync(BuilderWidget $widget) {
		$this->storages[0]->read($widget);
		$last_widget = clone $widget;
		$this->storages[0]->lock(true, $widget);
		$widget = $last_widget;
		$this->storages[1]->read($widget);
		$this->storages[1]->write($widget);

		/*$this->storages[1]->read($widget);
		$current_widget = clone $widget;

		$this->storages[0]->read($widget);
		$this->storages[0]->lock(true, $widget);
		echo "<h1>Item Storage 2</h1>";
		var_dump($current_widget->items);
		echo "<hr>";
		echo "<h1>Item Storage 1</h1>";
		var_dump($widget->items);
		//
		$widget->items = array_merge($current_widget->items, $widget->items);
		echo "<hr>";
		echo "<h1>Item After Array Merge</h1>";
		var_dump($widget->items);
		$this->storages[1]->write($widget);
		*/
	}

	/**
	 * @return mixed
	 */
	public function chooseStorage()
	{
		return \Yii::$app->user->isGuest ? $this->storages[0] : $this->storages[1];
	}

	/**
	 * @param BuilderWidget $widget
	 */
	public function read(BuilderWidget $widget)
	{
		$this->chooseStorage()->read($widget);
	}

	/**
	 * @param BuilderWidget $widget
	 */
	public function write(BuilderWidget $widget)
	{
		$this->chooseStorage()->write($widget);
	}

	/**
	 * @param $drop
	 * @param BuilderWidget $widget
	 */
	public function lock($drop, BuilderWidget $widget)
	{
		$this->chooseStorage()->lock($drop, $widget);
	}
}