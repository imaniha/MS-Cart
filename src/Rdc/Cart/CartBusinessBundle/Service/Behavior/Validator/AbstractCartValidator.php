<?php
namespace Rdc\Cart\CartBusinessBundle\Service\Behavior\Validator;

use Rdc\Cart\CartBusinessBundle\Entity\Cart;

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



    abstract function validate();

}