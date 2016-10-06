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
    private $item_id;

    /**
     * @var integer
     */
    private $quantity;

    /**
     * @var array
     */
    private $additional_data;
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

        $this->item_id =  $data['item_id'];
        $this->quantity =  $data['quantity'];
        $this->additional_data =  $data['additional_data'];

    }

    public function toArray()
    {
        return array(
            'item_id' => $this->item_id,
            'quantity' => $this->quantity,
            'additional_data' => $this->additional_data
        );

    }

    public function getItemId()
    {
        return $this->item_id;
    }

    /**
     * @param int $item_id
     */
    public function setItemId($item_id)
    {
        $this->item_id = $item_id;
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
        return $this->additional_data;
    }

    /**
     * @param array $additional_data
     */
    public function setAdditionalData($additional_data)
    {
        $this->additional_data = $additional_data;
    }


}
