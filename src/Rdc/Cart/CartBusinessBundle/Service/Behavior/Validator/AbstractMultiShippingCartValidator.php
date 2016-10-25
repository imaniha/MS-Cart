<?php
namespace Rdc\Cart\CartBusinessBundle\Service\Behavior\Validator;

use Rdc\Cart\CartBusinessBundle\Entity\Cart;
use Rdc\Cart\CartBusinessBundle\Vo\Behavior;
use Rdc\Cart\CartBusinessBundle\Service\Behavior\Exception\BehaviorException;

Abstract class AbstractMultiShippingCartValidator extends AbstractCartValidator
{
    const TYPE = '';

    /**
     * @var string
     */
    private $behavior;

    /**
     * @var string
     */
    private $shipping;

    /**
     * @var string
     */
    private $items;

    public function __construct($cart)
    {
        parent::__construct($cart);
        $this->setShipping($cart->getShippingsAsArray());
        $this->setBehavior($cart->getBehaviorsByType(static::TYPE));
    }

    public function validate()
    {
        foreach ($this->getBehavior() as $source => $behavior) {

            //check if shippingType exist
            $this->checkShipping($source);

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

    /**
     * @return string
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * @param string $shipping
     */
    public function setShipping($shipping)
    {
        $this->shipping = $shipping;
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
    public function checkShipping($shippingId)
    {
        if (!$this->getShipping() || !isset($this->getShipping()[$shippingId])) {

            throw new BehaviorException(sprintf('Invalid Behavior: Shipping %d does not exist', $shippingId));
        }

        return;
    }
}
