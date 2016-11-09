<?php

namespace Rdc\Cart\CartBusinessBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\AccessorOrder;

use Rdc\Cart\CartBusinessBundle\Vo\Address;
use Rdc\Cart\CartBusinessBundle\Vo\Behavior;
use Rdc\Cart\CartBusinessBundle\Vo\Customer;
use Rdc\Cart\CartBusinessBundle\Vo\Payment;
use Rdc\Cart\CartBusinessBundle\Vo\DeliveryMethod;
use Rdc\Cart\CartBusinessBundle\Vo\Item;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Cart
 * @ExclusionPolicy("all")
 * @AccessorOrder("alphabetical")
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
     */
    private $items = [];

    /**
     * @var Customer
     * @Expose
     */
    private $customer;

    /**
     * @var array
     */
    private $address;

    /**
     * @var Payment
     * @Expose
     */
    private $payment;

    /**
     * @var array
     */
    private $deliveryMethods = [];

    /**
     * @var array
     */
    private $behaviors;

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
     * @VirtualProperty
     * @SerializedName("items")
     *
     * @return string
     */
    public function getItemsBehavior()
    {
        if (null === $this->behaviors) {
            return $this->items;
        }
        foreach ($this->items as &$item) {
            $item = $this->behaviorResolver($item);
        }

        return $this->items;
    }

    /**
     * @VirtualProperty
     * @SerializedName("address")
     *
     * @return string
     */
    public function getFlatAddresses()
    {
        $collection = new ArrayCollection();
        if (is_array($this->address)) {
            foreach ($this->address as $type) {
                foreach ($type as $address) {
                    $collection->add($address);
                }
            }
        } else {
            return null;
        }

        return $collection;
    }


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
    public function setPromotion(
        $promotion
    ) {
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
    public function setShopId(
        $shopId
    ) {
        $this->shopId = $shopId;

        return $this;
    }

    /**
     * /**
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
    public function setChannel(
        $channel
    ) {
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
    public function setStatus(
        $status
    ) {
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
    public function setNotified(
        $notified
    ) {
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
        if (null === $this->items) {
            return null;
        }

        $collection = new ArrayCollection();

        foreach ($this->items as $item) {
            if (is_object($item)) {
                $collection->add($item);
            } else {
                $collection->add(new Item($item));
            }
        }

        return $collection;
    }

    /**
     * Get items
     *
     * @return array
     */
    public function getItemsAsArray()
    {

        return $this->items;
    }

    /**
     * Get itemsStoresId
     *
     * @return array
     */
    public function getItemsStoresId()
    {
        $stores = [];
        foreach ($this->items as $item) {

            if (isset($item['store_id'])) {
                $stores[$item['store_id']][] = $item;
            }
        }

        return $stores;
    }

    public function addItem($item)
    {

        if (!$item->getItemId() && $item->getOfferId()) {
            $item->setItemId(rand(1, 1000));
        }

        if ($item->getOfferId()) {
            $this->items[$item->getItemId()] = $item->toArray();
            $this->setItems($this->items);
        }

        return $this;
    }

    public function removeItem($item)
    {

        return $this;
    }


    /**
     * Set behaviors
     *
     * @param array $behavior
     * @return Cart
     */
    public function setBehaviors($behaviors)
    {

        $this->behaviors = $behaviors;

        return $this;
    }

    /**
     * Get behaviors
     *
     * @return array
     */
    public function getBehaviors()
    {
        if (null === $this->behaviors) {
            return null;
        }

        $collection = new ArrayCollection();

        foreach ($this->behaviors as $behavior) {
            if (is_object($behavior)) {
                $collection->add($behavior);
            } else {
                foreach ($behavior as $source) {
                    $collection->add(new Behavior($source));
                }

            }
        }

        return $collection;
    }

    /**
     * Get behaviors
     *
     * @return array
     */
    public function getBehaviorsByType($type)
    {

        return isset($this->behaviors[$type]) ? $this->behaviors[$type] : null;
    }

    public function addBehavior($behavior)
    {

        if ($behavior->getType()) {
            $this->behaviors[$behavior->getType()][$behavior->getSource()] = $behavior->toArray();
            $this->setBehaviors($this->behaviors);
        }

        return $this;
    }

    public function removeBehavior($behaviors)
    {

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
     * Set address
     *
     * @param array $address
     * @return Cart
     */
    public function setAddress($addresses)
    {

        if ($addresses instanceof ArrayCollection) {
            foreach ($addresses as $address) {
                if ($address->getAddressId()) {
                    //reset address and addresses behaviors
                    unset($this->address[$address->getType()], $this->behaviors[$address->getType()]);
                }
            }
        }

        if ($addresses instanceof ArrayCollection) {
            foreach ($addresses as $address) {
                if ($address->getAddressId()) {
                    $this->address[$address->getType()][$address->getAddressId()] = $address->toArray();
                }
            }
        } else {
            $this->address = $addresses;
        }

        return $this;
    }

    /**
     * Get address
     *
     * @return array
     */
    public function getAddress()
    {
        if (null === $this->address) {
            return null;
        }

        $collection = new ArrayCollection();

        foreach ($this->address as $type) {
            foreach ($type as $add) {
                if (is_object($add)) {
                    $collection->add($add);
                } else {
                    $collection->add(new Address($add));
                }
            }
        }

        return $collection;
    }

    /**
     * Get address
     *
     * @return array
     */
    public function getAddressByType($type)
    {
        if (null === $this->address) {
            return null;
        }

        return isset($this->address[$type]) ? $this->address[$type] : null;
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
     * Set deliveryMethods
     *
     * @param array $deliveryMethods
     * @return Cart
     */
    public function setDeliveryMethods($deliveryMethods)
    {

        //reset existing deliveryMethods
        $this->deliveryMethods = [];
        unset($this->behaviors['delivery_method_item'], $this->behaviors['delivery_method_store']);

        if ($deliveryMethods instanceof ArrayCollection) {
            foreach ($deliveryMethods as $deliveryMethod) {
                if ($deliveryMethod->getTypeId()) {
                    $this->deliveryMethods[$deliveryMethod->getTypeId()] = $deliveryMethod->toArray();
                }
            }
        } else {
            $this->deliveryMethods = $deliveryMethods;
        }

        return $this;
    }

    /**
     * Get deliveryMethods
     *
     * @return array
     */
    public function getDeliveryMethods()
    {
        if (null === $this->deliveryMethods) {
            return null;
        }

        $collection = new ArrayCollection();

        foreach ($this->deliveryMethods as $deliveryMethod) {
            if (is_object($deliveryMethod)) {
                $collection->add($deliveryMethod);
            } else {
                $collection->add(new DeliveryMethod($deliveryMethod));
            }
        }

        return $collection;
    }

    /**
     * @VirtualProperty
     * @SerializedName("delivery_methods")
     *
     * @return string
     */
    public function getFlatDeliveryMethods()
    {
        $collection = new ArrayCollection();
        if (is_array($this->deliveryMethods)) {
            foreach ($this->deliveryMethods as $deliveryMethods) {
                $collection->add($deliveryMethods);
            }
        } else {
            return null;
        }

        return $collection;
    }


    /**
     * Get deliveryMethods
     *
     * @return array
     */
    public function getDeliveryMethodsAsArray()
    {

        return $this->deliveryMethods;
    }

    /**
     * @param $item
     * @return $item with integrated behaviors
     */
    private function behaviorResolver($item)
    {
        $behaviorFields = [
            'billing_address' => 'billing_address_id',
            'shipping_address' => 'shipping_address_id',
            'delivery_method_item' => 'delivery_method_id',
            'delivery_method_store' => 'delivery_method_id',
        ];

        foreach ($behaviorFields as $type => $field) {
            $default_id = null;

            if ((isset($this->behaviors[$type]) && (null !== $behaviors = $this->behaviors[$type])) && !isset($item[$field])) {
                foreach ($behaviors as $behavior) {
                    if (count($behavior['target']) == 0) {
                        $default_id = $behavior['source'];
                    }
                    if (in_array($item['item_id'], $behavior['target'])) {
                        $item[$field] = $behavior['source'];
                    }
                }
            }
            if (!isset($item[$field])) {
                $item[$field] = $default_id;
            }
        }

        return $item;
    }
}
