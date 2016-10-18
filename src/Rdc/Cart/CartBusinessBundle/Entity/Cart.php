<?php

namespace Rdc\Cart\CartBusinessBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Rdc\Cart\CartBusinessBundle\Vo\Address;
use Rdc\Cart\CartBusinessBundle\Vo\Customer;
use Rdc\Cart\CartBusinessBundle\Vo\Payment;
use Rdc\Cart\CartBusinessBundle\Vo\Shipping;
use Rdc\Cart\CartBusinessBundle\Vo\Item;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Cart
 * @ExclusionPolicy("all")
 */
class Cart
{
    public static $cartStatus = [
        'CART_STATUS_OPEN' => 1,
        'CART_STATUS_LOCKED' => 2,
        'CART_STATUS_CLOSED' => 3,
    ];

    /**
     * @var int
     * @Expose
     */
    private $cart_id;

    /**
     * Cart shop id
     * @var int
     * @Expose
     */
    private $shopId;

    /**
     * Cart channel
     * @var string
     * @Expose
     */
    private $channel;

    /**
     * Cart status
     * @var string
     * @Expose
     */
    private $status;

    /**
     * Cart Notified
     * @var boolean
     */
    private $notified;

    /**
     * @var array
     * @Expose
     */
    private $items = [];

    /**
     * @var Customer
     * @Expose
     */
    private $customer;

    /**
     * @var Address
     * @Expose
     */
    private $address;

    /**
     * @var Payment
     * @Expose
     */
    private $payment;

    /**
     * @var Shipping
     * @Expose
     */
    private $shipping;

    /**
     * @var array
     * @Expose
     */
    private $additionalData;

    /**
     * @var array
     * @Expose
     */
    private $promotion;

    /**
     * @return int
     */
    public function getCartId()
    {
        return $this->cart_id;
    }

    /**
     * @return array
     */
    public function getPromotion()
    {
        $return = [];
        foreach ($this->promotion as $promotion) {
            $return[] = new Promotion($promotion);
        }

        return $return;
    }

    /**
     * @param $promotion
     */
    public function setPromotion($promotion)
    {
        foreach ($promotion as $promo) {
            $this->promotion[] = $promo->toArray();
        }
    }

    /**
     * Set shopId
     *
     * @param integer $shopId
     * @return Cart
     */
    public function setShopId($shopId)
    {
        $this->shopId = $shopId;

        return $this;
    }

    /**
    /**
     * Get shopId
     *
     * @return integer
     */
    public function getShopId()
    {
        return $this->shopId;
    }

    /**
     * Set channel
     *
     * @param string $channel
     * @return Cart
     */
    public function setChannel($channel)
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * Get channel
     *
     * @return string
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Cart
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return boolean
     */
    public function isNotified()
    {
        return $this->notified;
    }

    /**
     * @param boolean $notified
     */
    public function setNotified($notified)
    {
        $this->notified = $notified;
    }


    /**
     * Set items
     *
     * @param array $items
     * @return Cart
     */
    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * Get items
     *
     * @return array
     */
    public function getItems()
    {
        $items = [];
        $collection = new ArrayCollection();

        foreach($this->items as $item)
        {
            $collection->add(new Item($item));
        }

        return $items;
    }

    public function addItem($item)
    {

        $this->items[$item->getItemId()] = $item->toArray();
        $this->setItems($this->items);

        return $this;
    }

    public function removeItem($item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Set customer
     *
     * @param \Rdc\Cart\CartBusinessBundle\Entity\Customer $customer
     */
    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer->toArray();
    }

    /**
     * Get customer
     *
     * @return \Rdc\Cart\CartBusinessBundle\Entity\Customer
     */
    public function getCustomer()
    {

        return ($this->customer ? new Customer($this->customer) : null);
    }

    /**
     * Set additionalData
     *
     * @param array $additionalData
     * @return Cart
     */
    public function setAdditionalData($additionalData)
    {
        $this->additionalData = $additionalData;

        return $this;
    }

    /**
     * Get additionalData
     *
     * @return array
     */
    public function getAdditionalData()
    {
        return $this->additionalData;
    }

    /**
     * @return \Rdc\Cart\CartBusinessBundle\Vo\Address
     */
    public function getAddress()
    {

        return ($this->address ? new Address($this->address) : null);
    }

    /**
     * @param \Rdc\Cart\CartBusinessBundle\Vo\Address $address
     */
    public function setAddress($address)
    {
        $this->address = $address->toArray();
    }

    /**
     * @return \Rdc\Cart\CartBusinessBundle\Entity\Payment
     */
    public function getPayment()
    {

        return ($this->payment ? new Payment($this->payment) : null);
    }

    /**
     * @param \Rdc\Cart\CartBusinessBundle\Entity\Payment $payment
     */
    public function setPayment($payment)
    {
        $this->payment = $payment->toArray();
    }

    /**
     * @return \Rdc\Cart\CartBusinessBundle\Entity\Shipping
     */
    public function getShipping()
    {

        return ($this->shipping ? new Shipping($this->shipping) : null);
    }

    /**
     * @param \Rdc\Cart\CartBusinessBundle\Entity\Shipping $shipping
     */
    public function setShipping($shipping)
    {
        $this->shipping = $shipping->toArray();
    }
}
