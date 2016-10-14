<?php

namespace Rdc\Cart\CartBusinessBundle\Vo;

/**
 * Shipping
 */
class Shipping
{

    /**
     * @var int
     */
    private $typeId;

    /**
     * @var string
     */
    private $typeName;

    /**
     * @var array
     */
    private $additionalData;

    public function __construct($data = [])
    {
        $default = [
            'type_id' => null,
            'type_name' => '',
            'additional_data' => '',
        ];

        $data = array_merge($default, $data);

        $this->typeId = $data['type_id'];
        $this->typeName = $data['type_name'];
        $this->additionalData = $data['additional_data'];

    }

    public function toArray()
    {

        return [
            'type_id' => $this->typeId,
            'type_name' => $this->typeName,
            'additional_data' => $this->additionalData,
        ];

    }

    /**
     * @return int
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * @param int $typeId
     */
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;
    }

    /**
     * @return string
     */
    public function getTypeName()
    {
        return $this->typeName;
    }

    /**
     * @param string $typeName
     */
    public function setTypeName($typeName)
    {
        $this->typeName = $typeName;
    }

    /**
     * @return array
     */
    public function getAdditionalData()
    {
        return $this->additionalData;
    }

    /**
     * @param array $additionalData
     */
    public function setAdditionalData($additionalData)
    {
        $this->additionalData = $additionalData;
    }


}
