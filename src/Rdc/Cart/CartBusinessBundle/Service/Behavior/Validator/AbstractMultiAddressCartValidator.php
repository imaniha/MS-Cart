<?php
namespace Rdc\Cart\CartBusinessBundle\Service\Behavior\Validator;

use Rdc\Cart\CartBusinessBundle\Entity\Cart;
use Rdc\Cart\CartBusinessBundle\Vo\Behavior;
use Rdc\Cart\CartBusinessBundle\Service\Behavior\Exception\BehaviorException;

Abstract class AbstractMultiAddressCartValidator extends AbstractCartValidator
{
    const TYPE = '';

    /**
     * @var string
     */
    private $behavior;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $items;

    public function __construct($cart)
    {
        parent::__construct($cart);
        $this->setAddress($cart->getAddressByType(static::TYPE));
        $this->setBehavior($cart->getBehaviorsByType(static::TYPE));
    }

    public function validate()
    {

        foreach ($this->getBehavior() as $source => $behavior) {

            //check if addressId exist
            $this->checkAddress($source);

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
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
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
    public function checkAddress($addressId)
    {
        if (!$this->getAddress() || !isset($this->getAddress()[$addressId])) {

            throw new BehaviorException(sprintf('Invalid Behavior: Address %d does not exist', $addressId));
        }

        return;
    }

    /**
     * @return Void the provided item exist
     * @throws BehaviorException if the provided item is not found
     */
    public function checkItem($itemId)
    {
        if (!$this->getItems() || !isset($this->getItems()[$itemId])) {

            throw new BehaviorException(sprintf('Invalid Behavior: Item %d does not exist', $itemId));
        }

        return;
    }

}
