<?php

namespace Rdc\Cart\CartBusinessBundle\Service\Behavior\Factory;

use Rdc\Cart\CartBusinessBundle\Entity\Cart;
use Rdc\Cart\CartBusinessBundle\Service\Behavior\Validator\AddressBillingCartBehaviorValidator;
use Rdc\Cart\CartBusinessBundle\Service\Behavior\Validator\AddressShippingCartBehaviorValidator;
use Rdc\Cart\CartBusinessBundle\Service\Behavior\Validator\DeliveryMethodItemCartBehaviorValidator;
use Rdc\Cart\CartBusinessBundle\Service\Behavior\Validator\DeliveryMethodStoreCartBehaviorValidator;

use Rdc\Cart\CartBusinessBundle\Service\Behavior\Exception\BadBehaviorValidatorDefinitionException;

class BehaviorValidatorFactory
{
    /**
     * Create staticly desired Behavior Validator
     *
     * @param string $type Type of BehaviorValidator to create
     *
     * @return \Rdc\Cart\CartBusinessBundle\Service\Behavior\Validator\AbstractCartBehaviorValidator instance
     */

    static public function get($type, Cart $cart)
    {
        $instance = null;

        switch ($type) {

            case 'shipping_address':
                $instance = new AddressShippingCartBehaviorValidator($cart);
                break;
            case 'billing_address':
                $instance = new AddressBillingCartBehaviorValidator($cart);
                break;
            case 'delivery_method_item':
                $instance = new DeliveryMethodItemCartBehaviorValidator($cart);
                break;
            case 'delivery_method_store':
                $instance = new DeliveryMethodStoreCartBehaviorValidator($cart);
                break;
            default:
                throw new BadBehaviorValidatorDefinitionException(sprintf('%s Behavior not found', $type));
        }

        return $instance;
    }
}