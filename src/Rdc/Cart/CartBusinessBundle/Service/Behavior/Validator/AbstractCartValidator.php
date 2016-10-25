<?php
namespace Rdc\Cart\CartBusinessBundle\Service\Behavior\Validator;

use Rdc\Cart\CartBusinessBundle\Entity\Cart;
use Rdc\Cart\CartBusinessBundle\Service\Behavior\Exception\BehaviorException;

Abstract class AbstractCartValidator
{
    /**
     * @var Cart
     */
    private $cart;

    public function __construct($cart)
    {
        $this->setCart($cart);
    }

    /**
     * @return string
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * @param string $cart
     */
    public function setCart(Cart $cart)
    {
        $this->cart = $cart;
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

    abstract function validate();
}