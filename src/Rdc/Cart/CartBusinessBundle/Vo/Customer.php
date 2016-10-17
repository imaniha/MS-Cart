<?php

namespace Rdc\Cart\CartBusinessBundle\Vo;

use Symfony\Component\OptionsResolver\OptionsResolver;
/**
 * Customer
 */
class Customer extends AbstractVo
{

    /**
     * @var int
     */
    private $customerId;

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
    private $additionalData;

    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'customer_id' => null,
                'firstname' => '',
                'lastname' => '',
                'email' => '',
                'additional_data' => '',
            ]
        );
    }

    /**
     * @return int
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param int $customerId
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
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
