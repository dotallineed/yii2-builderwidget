<?php
/**
 * @link https://www.github.com/dotallineed/yii2-cart
 * @copyright Copyright (c) 2016 dotallineed.com
 * @license http://www.yiiframework.com/license/
 */
 
namespace magaga\builderwidgets;

use yii\base\Behavior;


/**
 * Class DiscountBehavior
 * @package \hscsstudio\cart
 */
class DiscountBehavior extends Behavior
{
    public function events()
    {
        return [
            Cart::EVENT_COST_CALCULATION => 'onCostCalculation',
            ItemInterface::EVENT_COST_CALCULATION => 'onCostCalculation',
        ];
    }

    /**
     * @param CostCalculationEvent $event
     */
    public function onCostCalculation($event)
    {

    }
}