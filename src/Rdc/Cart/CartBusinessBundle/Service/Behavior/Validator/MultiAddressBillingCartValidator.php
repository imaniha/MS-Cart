<?php

namespace Rdc\Cart\CartBusinessBundle\Service\Behavior\Validator;

use Rdc\Cart\CartBusinessBundle\Service\Behavior\Validator\AbstractMultiAddressCartValidator;
use Rdc\Cart\CartBusinessBundle\Entity\Cart;
use Rdc\Cart\CartBusinessBundle\Vo\Behavior;
use Rdc\Cart\CartBusinessBundle\Service\Behavior\Exception\BehaviorException;

class MultiAddressBillingCartValidator extends AbstractMultiAddressCartValidator
{

    const TYPE = 'billing';

    public function __construct(Cart $cart)
    {
        parent::__construct($cart);
        $this->setItems($cart->getItemsAsArray());
        $this->setBehavior($cart->getBehaviorsByType('MultiAddressBillingCart'));
    }

}

