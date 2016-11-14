<?php

namespace Rdc\Cart\CartBusinessBundle\Service;

use Rdc\Mid\RdcMidBundle\Service\Logger\ApplicationLogger;
use Rdc\Cart\CartBusinessBundle\Service\AddressBusiness;
use Rdc\Cart\CartBusinessBundle\Service\CustomerBusiness;
use JMS\Serializer\Serializer;
use Doctrine\ORM\EntityManager;
use Rdc\Cart\CartBusinessBundle\Entity\Cart;
use Rdc\Cart\CartBusinessBundle\Exception\CartException;


class CartBusiness
{
    protected $addressBusiness;
    protected $customerBusiness;

    public function __construct(
        ApplicationLogger $logger,
        EntityManager $entityManager,
        Serializer $serializer,
        AddressBusiness $addressBusiness,
        CustomerBusiness $customerBusiness
    ) {
        $this->logger = $logger;
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
            $exception = new CartException(CartException::CART_NOT_LOCKED, ['cart_id'=>$cart->getCartId()] );
            $this->logger->logException('Failed to create cart', $exception);
            throw $exception;
        }

        $cart->setNotified(true);
        $this->em->persist($cart);
        $this->em->flush();

        return $cart;
    }

    public function getUnnotifiedOrders()
    {

        return $this->em->getRepository('CartBusinessBundle:Cart')->findBy(['status'=>2, 'notified'=>false]);
    }

    public function getCartSummary($cartId)
    {
        // TODO implement method
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

