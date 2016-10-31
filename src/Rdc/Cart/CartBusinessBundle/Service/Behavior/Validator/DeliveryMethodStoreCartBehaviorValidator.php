<?php

namespace Rdc\Cart\CartBusinessBundle\Service\Behavior\Validator;

use Rdc\Cart\CartBusinessBundle\Service\Behavior\Validator\AbstractShippingCartBehaviorValidator;
use Rdc\Cart\CartBusinessBundle\Entity\Cart;
use Rdc\Cart\CartBusinessBundle\Vo\Behavior;
use Rdc\Cart\CartBusinessBundle\Service\Behavior\Exception\BehaviorException;

class DeliveryMethodStoreCartBehaviorValidator extends AbstractShippingCartBehaviorValidator
{
    const TYPE = 'shipping_type_store';

    /**
     * @var string
     */
    private $stores;

    public function __construct(Cart $cart)
    {
        parent::__construct($cart);
        $this->setItems($cart->getItemsAsArray());
        $this->setStores($cart->getItemsStoresId());
    }

    /**
     * @return string
     */
    public function getStores()
    {
        return $this->stores;
    }

    /**
     * @param string $stores
     */
    public function setStores($stores)
    {
        $this->stores = $stores;
    }



    public function validate()
    {
        foreach ($this->getBehavior() as $source => $behavior) {

            //check if shippingType exist
            $this->checkDeliveryMethod($source);

            $behavior = new Behavior($behavior);
            foreach ($behavior->getTarget() as $target) {

                //check if store exist
                $this->checkStore($target);

                !isset($tmp_array[$behavior->getType()]) ? $tmp_array[$behavior->getType()] = array() : '';
                !isset($tmp_array[$behavior->getType()][$target]) ? $tmp_array[$behavior->getType()][$target] = 0 : '';
                $tmp_array[$behavior->getType()][$target] += 1;

                if ($tmp_array[$behavior->getType()][$target] > 1) {
                    throw new BehaviorException(sprintf('Invalid Behavior: store %d as several Addresses', $target));
                }
            }
        }

        return;
    }

    /**
     * @return Void the provided item exist
     * @throws BehaviorException if the provided item is not found
     */
    public function checkStore($storeId)
    {
        if (!$this->getStores() || !isset($this->getStores()[$storeId])) {

            throw new BehaviorException(sprintf('Invalid Behavior: Store %d does not exist', $storeId));
        }

        return;
    }
}
