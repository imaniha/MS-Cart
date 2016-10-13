<?php

namespace Rdc\Cart\CartBusinessBundle\Entity;

/**
 * Item
 */
class Item
{

    /**
     * @var int
     */
    private $itemId;

    /**
     * @var integer
     */
    private $quantity;

    /**
     * @var array
     */
    private $additionalData;
    /**
     * @return int
     */

    public function __construct($data = array())
    {
        $default = [
            'item_id' => null,
            'quantity' => null,
            'additional_data' => '',
        ];

        $data = array_merge($default, $data);

        $this->itemId =  $data['item_id'];
        $this->quantity =  $data['quantity'];
        $this->additionalData =  $data['additional_data'];

    }

    public function toArray()
    {
        return array(
            'item_id' => $this->itemId,
            'quantity' => $this->quantity,
            'additional_data' => $this->additionalData
        );
    }

    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * @param int $itemId
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return array
     */
    public function getAdditionalData()
    {
        return $this->additionalData;
    }

    /**
     * @param array $additional_data
     */
    public function setAdditionalData($additionalData)
    {
        $this->additionalData = $additionalData;
    }


}
