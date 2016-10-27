<?php

namespace Rdc\Cart\CartBusinessBundle\Service\Behavior\Validator;

use Rdc\Cart\CartBusinessBundle\Service\Behavior\Validator\AbstractAddressCartBehaviorValidator;
use Rdc\Cart\CartBusinessBundle\Entity\Cart;
use Rdc\Cart\CartBusinessBundle\Vo\Behavior;
use Rdc\Cart\CartBusinessBundle\Service\Behavior\Exception\BehaviorException;

class AddressShippingCartBehaviorValidator extends AbstractAddressCartBehaviorValidator
{
    const TYPE = 'shipping_address';

    public function __construct(Cart $cart)
    {
        parent::__construct($cart);
        $this->setItems($cart->getItemsAsArray());
    }
}
