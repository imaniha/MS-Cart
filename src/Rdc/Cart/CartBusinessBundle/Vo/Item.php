<?php

namespace Rdc\Cart\CartBusinessBundle\Vo;

use Symfony\Component\OptionsResolver\OptionsResolver;
/**
 * Item
 */
class Item extends AbstractVo
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

    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'item_id' => null,
                'quantity' => null,
                'additional_data' => '',
            ]
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
