<?php
/**
 * @link https://www.github.com/dotallineed/yii2-builderwidget
 * @copyright Copyright (c) 2016 dotallineed.com
 * @license http://www.yiiframework.com/license/
 */
 
namespace dotallineed\widgetsbuilder;

/**
 * Abstract Class Storage
 *
 * It's basic class that should extended for create storage
 *
 * @author Kinggeorge Magaga <magagageorge@dotallineed.com>
 * @since 1.0
 *	
 * @property string $serialized Get/set serialized content of the widget
 */
 
abstract class Storage extends \yii\base\Object
{
	
	/**
	* Abstract function for read widget data from storage.
	* @param BuilderWidget $widget
	*/
	abstract public function read(BuilderWidget $widget);
	
	/**
	* Abstract function for write widget data from storage.
	* @param BuilderWidget $widget
	*/
	abstract public function write(BuilderWidget $widget);
	
	/**
	* Abstract function for lock widget data from storage.
	* @param BuilderWidget $widget
	*/
	abstract public function lock($drop, BuilderWidget $widget);
	
	/**
     * Sets widget from serialized string
     * @param string $serialized
     */
    public function unserialize($serialized, BuilderWidget $widget)
    {
        $widget->items = unserialize($serialized);
    }
	
	/**
     * Returns items as serialized items
     * @return string
     */
    public function serialize(BuilderWidget $widget)
    {
        return serialize($widget->items);
    }
}