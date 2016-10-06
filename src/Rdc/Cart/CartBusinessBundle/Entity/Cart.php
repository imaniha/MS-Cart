<?php

namespace Rdc\Cart\CartBusinessBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

use Rdc\Cart\CartBusinessBundle\Entity\Address;
use Rdc\Cart\CartBusinessBundle\Entity\Customer;
use Rdc\Cart\CartBusinessBundle\Entity\Payment;
use Rdc\Cart\CartBusinessBundle\Entity\Shipping;
use Rdc\Cart\CartBusinessBundle\Entity\Item;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Cart
 */
class Cart
{
    public static $cartStatus = array(
        'CART_STATUS_OPEN' => 1,
        'CART_STATUS_LOCKED' => 2,
        'CART_STATUS_CLOSED' => 3,
    );

    /**
     * @var int
     */
    private $cart_id;

    /**
     * Cart shop id
     * @var int
     */
    private $shopId;

    /**
     * Cart channel
     * @var string
     */
    private $channel;

    /**
     * Cart status
     * @var string
     */
    private $status;

    /**
     * Cart Notified
     * @var boolean
     */
    private $notified;

    /**
     * @var array
     */
    private $items;

    /**
     * @var Customer
     */
    private $customer;

    /**
     * @var Address
     */
    private $address;

    /**
     * @var Payment
     */
    private $payment;

    /**
     * @var Shipping
     */
    private $shipping;

    /**
     * @var array
     */
    private $additionalData;

    /**
     * @var array
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
     * Get item_id
     *
     * @return integer
     */
    public function getItemId()
    {
        return $this->item_id;
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
        $items = array();

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
        if ($this->customer) {
            return new Customer($this->customer);
        } else {
            return null;
        }
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
     * @return \Rdc\Cart\CartBusinessBundle\Entity\Address
     */
    public function getAddress()
    {
        if ($this->address) {
            return new Address($this->address);
        } else {
            return null;
        }
    }

    /**
     * @param \Rdc\Cart\CartBusinessBundle\Entity\Address $address
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
        if ($this->payment) {
            return new Payment($this->payment);
        } else {
            return null;
        }
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
        if ($this->shipping) {
            return new Shipping($this->shipping);
        } else {
            return null;
        }

    }

    /**
     * @param \Rdc\Cart\CartBusinessBundle\Entity\Shipping $shipping
     */
    public function setShipping($shipping)
    {
        $this->shipping = $shipping->toArray();
    }
}
