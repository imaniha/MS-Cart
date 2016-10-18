<?php

namespace Rdc\Cart\CartBusinessBundle\Service;

use Rdc\Cart\CartBusinessBundle\Service\AddressBusiness;
use Rdc\Cart\CartBusinessBundle\Service\CustomerBusiness;
use JMS\Serializer\Serializer;
use Doctrine\ORM\EntityManager;
use Rdc\Cart\CartBusinessBundle\Entity\Cart;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CartBusiness
{
    protected $addressBusiness;
    protected $customerBusiness;

    public function __construct(
        EntityManager $entityManager,
        Serializer $serializer,
        AddressBusiness $addressBusiness,
        CustomerBusiness $customerBusiness
    ) {
        $this->em = $entityManager;
        $this->serializer = $serializer;
        $this->addressBusiness = $addressBusiness;
        $this->customerBusiness = $customerBusiness;
    }

    public function createCart($cart)
    {

        $this->em->persist($cart);
        $this->em->flush();

        return $cart;
    }

    public function notify($cart)
    {

        if ('2' !== $cart->getStatus()) {
            throw new \LogicException('Cart should be locked to be notified');
        }

        $cart->setNotified(true);
        $this->em->persist($cart);
        $this->em->flush();

        return $cart;
    }

    public function getCart($cartId = null)
    {
        $cart = $this->em->getRepository('CartBusinessBundle:Cart')->findOneBy(['cart_id' => $cartId]);

        if (!$cart instanceof Cart) {
            throw new NotFoundHttpException('Cart not found');
        }

        return $cart;
    }

    public function getUnnotifiedOrders()
    {

        return $this->em->getRepository('CartBusinessBundle:Cart')->findBy(['status'=>2, 'notified'=>false]);
    }

    public function addItem($cartId, $item, $extra)
    {
        $cart = $this->getCart($cartId);
        $item = $this->serializer->toArray($item);
        $items = $cart->getItems();
        $items[$item['item_id']] = array_merge($item, $extra);

        $cart->setItems($items);
        $this->em->persist($cart);
        $this->em->flush();

        return $cart;
    }


    public function deleteItem($cartId, $item_id)
    {
        $cart = $this->getCart($cartId);
        $items = $cart->getItems();
        if (isset($items[$item_id])) {
            unset($items[$item_id]);
            $cart->setItems($items);
            $this->em->persist($cart);
            $this->em->flush();
        }

        return $cart;
    }

    public function getCartSummary($cartId)
    {
        // TODO implement method
    }

    public function addPromotion($cartId, $promotion)
    {
        $cart = $this->getCart($cartId);
        $cart->setPromotion($promotion);

        $this->em->persist($cart);
        $this->em->flush();

        return $cart;
    }

    public function addDeliveryMethod($cartId)
    {
        // TODO implement method
    }

    public function cloneCart($cartId)
    {
        // TODO implement method
    }

    public function closeCart($cartId)
    {
        // TODO implement method
    }

    public function resetCart($cartId)
    {
        // TODO implement method
    }

    public function mergeCart($cartId)
    {
        // TODO implement method
    }
}

