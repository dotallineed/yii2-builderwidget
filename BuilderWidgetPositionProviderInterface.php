<?php

namespace magaga\builderwidgets;


/**
 * Interface CartPositionProviderInterface
 * @property CartPositionInterface $cartPosition
 * @package yz\shoppingcart
 */
interface BuilderWidgetPositionProviderInterface
{
    /**
     * @param array $params Parameters for cart position
     * @return CartPositionInterface
     */
    public function getBuilderWidgetPosition($params = []);
} 