<?php
/**
 * @link https://www.github.com/dotallineed/yii2-cart
 * @copyright Copyright (c) 2016 dotallineed.com
 * @license http://www.yiiframework.com/license/
 */
 
namespace dotallineed\widgetsbuilder;


/**
 * Interface ItemInterface
 * @property int $price
 * @property int $cost
 * @property string $id
 * @property int $quantity
 * @package \hscsstudio\cart
 */
 
interface ItemInterface
{

    /** Triggered on cost calculation */
    const EVENT_COST_CALCULATION = 'costCalculation';
	
	/**
     * @return integer
     */
    public function getPrice();

    /**
     * @return string
     */
    public function getId();


    /**
     * @param bool $withDiscount
     * @return integer
     */
    public function getCost($withDiscount = true);



    /**
     * @param int $quantity
     */
    public function setQuantity($quantity);

    /**
     * @return int
     */
    public function getQuantity();

} 