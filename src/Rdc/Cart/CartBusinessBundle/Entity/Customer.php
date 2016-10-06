<?php

namespace Rdc\Cart\CartBusinessBundle\Entity;

/**
 * Customer
 */
class Customer
{

    /**
     * @var int
     */
    private $customer_id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var array
     */
    private $additional_data;

    public function __construct($data = array())
    {
        $default = [
            'customer_id' => null,
            'firstname' => '',
            'lastname' => '',
            'email' => '',
            'additional_data' => '',
        ];

        $data = array_merge($default, $data);

        $this->customer_id =  $data['customer_id'];
        $this->firstname =  $data['firstname'];
        $this->lastname =  $data['lastname'];
        $this->email =  $data['email'];
        $this->additional_data =  $data['additional_data'];

    }

    public function toArray()
    {

        return array(
            'customer_id' => $this->customer_id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'additional_data' => $this->additional_data
        );

    }

    /**
     * @return int
     */
    public function getCustomerId()
    {
        return $this->customer_id;
    }

    /**
     * @param int $customer_id
     */
    public function setCustomerId($customer_id)
    {
        $this->customer_id = $customer_id;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
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
