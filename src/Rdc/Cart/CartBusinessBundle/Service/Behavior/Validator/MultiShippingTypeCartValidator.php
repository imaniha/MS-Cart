<?php

namespace Rdc\Cart\CartBusinessBundle\Service\Behavior\Validator;

use Rdc\Cart\CartBusinessBundle\Service\Behavior\Validator\AbstractMultiShippingCartValidator;
use Rdc\Cart\CartBusinessBundle\Entity\Cart;
use Rdc\Cart\CartBusinessBundle\Vo\Behavior;
use Rdc\Cart\CartBusinessBundle\Service\Behavior\Exception\BehaviorException;

class MultiShippingTypeCartValidator extends AbstractMultiShippingCartValidator
{
    const TYPE = 'shipping_type';

    public function __construct(Cart $cart)
    {
        parent::__construct($cart);
        $this->setItems($cart->getItemsAsArray());
    }
}
