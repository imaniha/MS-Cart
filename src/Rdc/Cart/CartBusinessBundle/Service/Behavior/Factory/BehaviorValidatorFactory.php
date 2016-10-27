<?php

namespace Rdc\Cart\CartBusinessBundle\Service\Behavior\Factory;

use Rdc\Cart\CartBusinessBundle\Entity\Cart;
use Rdc\Cart\CartBusinessBundle\Service\Behavior\Validator\AddressBillingCartBehaviorValidator;
use Rdc\Cart\CartBusinessBundle\Service\Behavior\Validator\AddressShippingCartBehaviorValidator;
use Rdc\Cart\CartBusinessBundle\Service\Behavior\Validator\ShippingTypeItemCartBehaviorValidator;
use Rdc\Cart\CartBusinessBundle\Service\Behavior\Validator\ShippingTypeStoreCartBehaviorValidator;

use Rdc\Cart\CartBusinessBundle\Service\Behavior\Exception\BadBehaviorValidatorDefinitionException;

class BehaviorValidatorFactory
{
    /**
     * Create staticly desired Behavior Validator
     *
     * @param string $type Type of BehaviorValidator to create
     *
     * @return LoggerInterface Logger instance
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
            case 'shipping_type_item':
                $instance = new ShippingTypeItemCartBehaviorValidator($cart);
                break;
            case 'shipping_type_store':
                $instance = new ShippingTypeStoreCartBehaviorValidator($cart);
                break;
            default:
                throw new BadBehaviorValidatorDefinitionException(sprintf('%s Behavior not found', $type));
        }

        return $instance;
    }
}