<?php

namespace Rdc\Cart\CartBusinessBundle\Entity;

/**
 * Address
 */
class Address
{

    /**
     * @var int
     */
    private $address_id;

    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var string
     */
    private $address1;

    /**
     * @var string
     */
    private $address2;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $zip;

    /**
     * @var string
     */
    private $country_code;

    /**
     * @var string
     */
    private $country_label;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $mobile_phone;

    /**
     * @var string
     */
    private $work_phone;

    /**
     * @var string
     */
    private $fax;

    /**
     * @var string
     */
    private $rcs;

    /**
     * @var string
     */
    private $access_code;

    /**
     * @var array
     */
    private $additional_data;

    public function __construct($data)
    {

        $default = [
            'address_id' => null,
            'firstname' => '',
            'lastname' => '',
            'address1' => '',
            'address2' => '',
            'city' => '',
            'zip' => '',
            'country_code' => '',
            'country_label' => '',
            'phone' => '',
            'mobile_phone' => '',
            'work_phone' => '',
            'fax' => '',
            'rcs' => '',
            'access_code' => '',
            'extra_data' => '',
            'additional_data' => '',
        ];

        $data = array_merge($default, $data);

        $this->address_id = $data['address_id'];
        $this->firstname = $data['firstname'];
        $this->lastname = $data['lastname'];
        $this->address1 = $data['address1'];
        $this->address2 = $data['address2'];
        $this->city = $data['city'];
        $this->zip = $data['zip'];
        $this->country_code = $data['country_code'];
        $this->country_label = $data['country_label'];
        $this->phone = $data['phone'];
        $this->mobile_phone = $data['mobile_phone'];
        $this->work_phone = $data['work_phone'];
        $this->fax = $data['fax'];
        $this->rcs = $data['rcs'];
        $this->access_code = $data['access_code'];
        $this->additional_data = $data['additional_data'];

    }

    public function toArray()
    {

        return array(
            'address_id' => $this->address_id,
            'lastname' => $this->lastname,
            'firstname' => $this->firstname,
            'address1' => $this->address1,
            'address2' => $this->address2,
            'city' => $this->city,
            'zip' => $this->zip,
            'country_code' => $this->country_code,
            'country_label' => $this->country_label,
            'phone' => $this->phone,
            'mobile_phone' => $this->mobile_phone,
            'work_phone' => $this->work_phone,
            'fax' => $this->fax,
            'rcs' => $this->rcs,
            'access_code' => $this->access_code,
            'additional_data' => $this->additional_data,
        );
    }

    /**
     * @return int
     */
    public function getAddressId()
    {
        return $this->address_id;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->country_code;
    }

    /**
     * @return string
     */
    public function getCountryLabel()
    {
        return $this->country_label;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getMobilePhone()
    {
        return $this->mobile_phone;
    }

    /**
     * @return string
     */
    public function getWorkPhone()
    {
        return $this->work_phone;
    }

    /**
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @return string
     */
    public function getRcs()
    {
        return $this->rcs;
    }

    /**
     * @return string
     */
    public function getAccessCode()
    {
        return $this->access_code;
    }

    /**
     * @return array
     */
    public function getAdditionalData()
    {
        return $this->additional_data;
    }


    /**
     * @param int $address_id
     */
    public function setAddressId($address_id)
    {
        $this->address_id = $address_id;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @param string $address1
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;
    }

    /**
     * @param string $address2
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @param string $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    /**
     * @param string $country_code
     */
    public function setCountryCode($country_code)
    {
        $this->country_code = $country_code;
    }

    /**
     * @param string $country_label
     */
    public function setCountryLabel($country_label)
    {
        $this->country_label = $country_label;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @param string $mobile_phone
     */
    public function setMobilePhone($mobile_phone)
    {
        $this->mobile_phone = $mobile_phone;
    }

    /**
     * @param string $work_phone
     */
    public function setWorkPhone($work_phone)
    {
        $this->work_phone = $work_phone;
    }

    /**
     * @param string $fax
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }

    /**
     * @param string $rcs
     */
    public function setRcs($rcs)
    {
        $this->rcs = $rcs;
    }

    /**
     * @param string $access_code
     */
    public function setAccessCode($access_code)
    {
        $this->access_code = $access_code;
    }

    /**
     * @param array $additional_data
     */
    public function setAdditionalData($additional_data)
    {
        $this->additional_data = $additional_data;
    }


}
