<?php

namespace Rdc\Cart\CartBusinessBundle\Service\Behavior\Factory;

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
    static public function get($type, $cart)
    {
        $instance = null;

        switch ($type) {

            case 'MultiAddressShippingCart':
                $instance = new MultiAddressShippingCartValidator($cart);
                break;

            case 'MultiAddressDeliveryCart':
                $instance = new MultiAddressDeliveryCartValidator($cart);
                break;

            case 'MultiAddressBillingCart':
                $instance = new MultiAddressBillingCartValidator($cart);
                break;

            default:
                throw new BadMultiValidatorDefinitionException(sprintf('%s Behavior not found', $type));
        }

        return $instance;
    }
}