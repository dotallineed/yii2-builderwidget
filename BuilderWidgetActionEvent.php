<?php
/**
 * @link https://www.github.com/dotallineed/yii2-cart
 * @copyright Copyright (c) 2016 dotallineed.com
 * @license http://www.yiiframework.com/license/
 */
 
namespace dotallineed\widgetsbuilder;
use yii\base\Event;


/**
 * Class BuilderWidgetActionEvent
 */
class BuilderWidgetActionEvent extends Event
{
    const ACTION_UPDATE = 'update';
    const ACTION_ITEM_PUT = 'itemPut';
    const ACTION_BEFORE_REMOVE = 'beforeRemove';
    const ACTION_REMOVE_ALL = 'removeAll';
    const ACTION_SET_ITEMS = 'setItems';

    /**
     * Name of the action taken on the cart
     * @var string
     */
    public $action;
    /**
     * Item of the cart that was affected. Could be null if action deals with all items of the cart
     * @var ItemInterface
     */
    public $item;
}