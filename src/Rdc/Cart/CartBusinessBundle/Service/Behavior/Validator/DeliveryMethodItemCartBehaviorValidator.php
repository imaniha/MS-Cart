<?php

namespace Rdc\Cart\CartBusinessBundle\Service\Behavior\Validator;

use Rdc\Cart\CartBusinessBundle\Service\Behavior\Validator\AbstractShippingCartBehaviorValidator;
use Rdc\Cart\CartBusinessBundle\Entity\Cart;
use Rdc\Cart\CartBusinessBundle\Vo\Behavior;
use Rdc\Cart\CartBusinessBundle\Service\Behavior\Exception\BehaviorException;

class DeliveryMethodItemCartBehaviorValidator extends AbstractShippingCartBehaviorValidator
{
    const TYPE = 'shipping_type_item';

    public function __construct(Cart $cart)
    {
        parent::__construct($cart);
        $this->setItems($cart->getItemsAsArray());
    }

    public function validate()
    {
        foreach ($this->getBehavior() as $source => $behavior) {

            //check if shippingType exist
            $this->checkDeliveryMethod($source);

            $behavior = new Behavior($behavior);
            foreach ($behavior->getTarget() as $target) {

                //check if item exist
                $this->checkItem($target);

                !isset($tmp_array[$behavior->getType()]) ? $tmp_array[$behavior->getType()] = array() : '';
                !isset($tmp_array[$behavior->getType()][$target]) ? $tmp_array[$behavior->getType()][$target] = 0 : '';
                $tmp_array[$behavior->getType()][$target] += 1;

                if ($tmp_array[$behavior->getType()][$target] > 1) {
                    throw new BehaviorException(sprintf('Invalid Behavior: Item %d as several Addresses', $target));
                }
            }
        }

        return;
    }
}
