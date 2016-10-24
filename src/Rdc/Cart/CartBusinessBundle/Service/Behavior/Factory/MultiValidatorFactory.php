<?php

namespace Rdc\Cart\CartBusinessBundle\Service\Behavior\Factory;

use Rdc\Cart\CartBusinessBundle\Entity\Cart;
use Rdc\Cart\CartBusinessBundle\Service\Behavior\Validator\MultiAddressBillingCartValidator;
use Rdc\Cart\CartBusinessBundle\Service\Behavior\Validator\MultiAddressDeliveryCartValidator;
use Rdc\Cart\CartBusinessBundle\Service\Behavior\Validator\MultiAddressShippingCartValidator;

use Rdc\Cart\CartBusinessBundle\Service\Behavior\Exception\BadMultiValidatorDefinitionException;

class MultiValidatorFactory
{
    /**
     * Create staticly desired Multi Validator
     *
     * @param string $type Type of MultiValidator to create
     *
     * @return LoggerInterface Logger instance
     */
    static public function get($type, Cart $cart)
    {
        $instance = null;

        switch ($type) {

            case 'shipping':
                $instance = new MultiAddressShippingCartValidator($cart);
                break;

            case 'delivery':
                $instance = new MultiAddressDeliveryCartValidator($cart);
                break;

            case 'billing':
                $instance = new MultiAddressBillingCartValidator($cart);
                break;

            default:
                throw new BadMultiValidatorDefinitionException(sprintf('%s Behavior not found', $type));
        }

        return $instance;
    }
}