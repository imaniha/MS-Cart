<?php

namespace Rdc\Cart\CartBusinessBundle\Entity;

/**
 * Payment
 */
class Payment
{

    /**
     * @var int
     */
    private $type_id;

    /**
     * @var string
     */
    private $type_name;

    /**
     * @var array
     */
    private $additional_data;

    public function __construct($data = array())
    {
        $default = [
            'type_id' => null,
            'type_name' => '',
            'additional_data' => '',
        ];

        $data = array_merge($default, $data);

        $this->type_id =  $data['type_id'];
        $this->type_name =  $data['type_name'];
        $this->additional_data =  $data['additional_data'];

    }

    public function toArray()
    {

        return array(
            'type_id' => $this->type_id,
            'type_name' => $this->type_name,
            'additional_data' => $this->additional_data
        );

    }

    /**
     * @return int
     */
    public function getTypeId()
    {
        return $this->type_id;
    }

    /**
     * @param int $type_id
     */
    public function setTypeId($type_id)
    {
        $this->type_id = $type_id;
    }

    /**
     * @return string
     */
    public function getTypeName()
    {
        return $this->type_name;
    }

    /**
     * @param string $type_name
     */
    public function setTypeName($type_name)
    {
        $this->type_name = $type_name;
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
