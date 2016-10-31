<?php
namespace Rdc\Cart\CartBusinessBundle\Service\Behavior\Validator;

use Rdc\Cart\CartBusinessBundle\Entity\Cart;
use Rdc\Cart\CartBusinessBundle\Vo\Behavior;
use Rdc\Cart\CartBusinessBundle\Service\Behavior\Exception\BehaviorException;

Abstract class AbstractDeliveryMethodCartBehaviorValidator extends AbstractCartBehaviorValidator
{
    const TYPE = '';

    /**
     * @var string
     */
    private $behavior;

    /**
     * @var string
     */
    private $deliveryMethods;

    /**
     * @var string
     */
    private $items;

    public function __construct($cart)
    {
        parent::__construct($cart);
        $this->setDeliveryMethod($cart->getDeliveryMethodsAsArray());
        $this->setBehavior($cart->getBehaviorsByType(static::TYPE));
    }

    /**
     * @return string
     */
    public function getDeliveryMethods()
    {
        return $this->deliveryMethods;
    }

    /**
     * @param string $deliveryMethods
     */
    public function setDeliveryMethods($deliveryMethods)
    {
        $this->deliveryMethods = $deliveryMethods;
    }

    /**
     * @return string
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param string $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }

    /**
     * @return string
     */
    public function getBehavior()
    {
        return $this->behavior;
    }

    /**
     * @param string $behavior
     */
    public function setBehavior($behavior)
    {
        $this->behavior = $behavior;
    }

    /**
     * @return Void the provided address exist
     * @throws BehaviorException if the provided address is not found
     */
    public function checkShipping($deliveryMethodId)
    {
        if (!$this->getDeliveryMethods() || !isset($this->deliveryMethods()[$deliveryMethodId])) {

            throw new BehaviorException(sprintf('Invalid Behavior: Shipping %d does not exist', $deliveryMethodId));
        }

        return;
    }
}
