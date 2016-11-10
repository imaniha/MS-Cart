<?php

namespace Rdc\Cart\CartBusinessBundle\Vo;

use Symfony\Component\OptionsResolver\OptionsResolver;
/**
 * Category
 */
class Category extends AbstractVo
{

    /**
     * @var string
     */
    private $value;

    /**
     * @var string
     */
    private $key;

    /**
     * @var array
     */
    private $additionalData;

    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'value' => null,
                'key' => null,
                'additional_data' => '',
            ]
        );
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
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
